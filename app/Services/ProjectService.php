<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use CodeProject\Validators\ProjectValidator;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\Filesystem;
use \Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * @property ProjectValidator validator
 * @property ProjectFileRepository repositoryFile
 */
class ProjectService
{
    private $repository;
    private $validator;
    private $repositoryFile;
    /**
     * @var Filesystem
     */
    private $file;
    /**
     * @var \CodeProject\Services\Storage
     */
    private $storage;
    private $validatorFile;


    /**
     * @param ProjectRepository $repository
     * @param ProjectFileValidator $validorFile
     * @param ProjectValidator $validator
     * @param Filesystem $file
     * @param Storage $storage
     */
    public function __construct(ProjectFileRepository $repositoryFile, ProjectRepository $repository,ProjectFileValidator $validorFile, ProjectValidator $validator, Filesystem $file, Storage $storage)
    {

        $this->repository = $repository;
        $this->repositoryFile = $repositoryFile;
        $this->validator = $validator;
        $this->validatorFile = $validorFile;
        $this->file = $file;
        $this->storage = $storage;
    }


    /**
     * @param $data
     * @return bool
     */
    public function isMember($id, $userId)
    {
        $project = $this->repository->find($id);

        if(count($project->members->find($userId)))
        {
            return true;
        }
        return false;
    }


    /**
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function  isOwner($projectId, $userId)
    {
        if(count($this->repository->findWhere(['id' => $projectId, 'owner_id' => $userId])))
        {
            return true;
        }

        return false;
    }

    private function checkPermissionProject($id, $userId){

        if($this->isOwner($id, $userId) or $this->isMember($id, $userId)){

            return true;
        }

        return false;
    }

    /**
     * @param $data
     * @return array
     */
    public function addMember($data)
    {
        try{
            if($this->isMember($data['project_id'],$data['user_id']))
            {
                return [
                    'error' => true,
                    'message' => 'You are already a member'
                ];
            }
            $project = $this->repository->find($data['project_id']);
            $project->members()->attach($data['user_id']);
            return $project;

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }


    /**
     * @param $mid
     * @param $id
     * @return array|bool
     */
    public function removeMember($mid,$id)
    {
        try{


            if($this->isMember($id, $mid)){

                $project = $this->repository->find($id);
                $project->members()->detach($mid);

            }else{

                return [
                    'error' => true,
                    'message' => 'No data found'
                ];
            }

            return $project;

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param $id
     * @param array $userId
     * @param array $with
     * @return array
     */
    public function show($id, $userId, $with = [])
    {

        try{
            if($this->checkPermissionProject($id, $userId)){

                return $this->repository->with($with)->find($id);

            }else{

                return ['sucess' => false];
            }

        }catch (ModelNotFoundException $e){

            return [
                'error' => true,
                'message' => 'No data found for id:'.$id
            ];
        }
    }

    public function index($with = [])
    {

        try{

            return  $this->repository->with($with)->all();

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (FatalErrorException $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }


    /**
     * @param $request
     * @return array|mixed
     */
    public function store(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        try{

            $this->repository->find($id)->delete();

            return ['deleted' => 'true'];

        }catch (ModelNotFoundException $e){
            return [
                'error' => true,
                'message' => 'No data found for id:'.$id
            ];
        }catch (QueryException $e){
            return [
                'error' => true,
                'message' => 'You cannot delete this data, there is register related!'
            ];
        }
    }

    public function createFile(array $data){

        try{

            $this->validatorFile->with($data)->passesOrFail();

            $file = $data['file'];
            $data['extension'] = $file->getClientOriginalExtension();

            $project = $this->repository->skipPresenter()->find($data['project_id']);

            $projectFile = $project->files()->create($data);

            $this->storage->put($projectFile->id.".".$data['extension'], $this->file->get($data['file']));

            return  [
                'sucess' => true,
                'message' => 'Image saved'
            ];

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroyImage($id)
    {
        try {

            $image = $this->repositoryFile->skipPresenter()->find($id);
            if (count($image)) {
                //  dd($this->storage->disk('local')->exists($image->id));

                if ($this->storage->exists($image->id . '.' . $image->extension)) {
                    $this->storage->delete($image->id . '.' . $image->extension);
                } else {
                    return [
                        'error' => true,
                        'message' => 'file does not exist'
                    ];
                }

                $image->delete();

                return [
                    'sucess' => true,
                    'message' => 'image deleted'
                ];
            }
        }catch(ModelNotFoundException $e)
        {
            return [
                'error' => true,
                'message' => 'image not found'
            ];
        }

    }
}