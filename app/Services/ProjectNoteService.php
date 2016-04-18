<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;

use CodeProject\Validators\ProjectNoteValidator;

class ProjectNoteService
{

    /**
     * @var ClientValidator
     */
    protected $validator;
    /**
     * @var ClientRepository
     */
    protected $repository;

    public function __construct(ProjectNoteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param array $with
     * @return array|mixed
     */
    public function index($id)
    {
        try{

            return  $this->repository->with(['project'])->findWhere(['project_id'=>$id]);

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
     * @param $id
     * @param array $with
     * @return array|mixed
     */
    public function show($id)
    {

        try{

            return $this->repository->find($id);


        }catch (ModelNotFoundException $e){
            return [
                'error' => true,
                'message' => 'No data found for id:'.$id
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
    public function store($request)
    {
        try{

            return $this->repository->create($request);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id)
    {
        try{
            $this->repository->skipPresenter()->find($id)->delete();
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





}