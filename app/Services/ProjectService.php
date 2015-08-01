<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;



class ProjectService extends Service
{
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        parent::__construct($repository, $validator);
    }

    public function isMember($data)
    {
        $project = $this->repository->find($data['project_id']);

        if(count($project->members->find($data['user_id'])))
        {
            return $project;
        }
        return false;
    }

    public function addMember($data)
    {
        try{
            if($this->isMember($data))
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

    public function removeMember($mid,$id)
    {
        try{

            $data = [
                'project_id' => $id,
                'user_id' =>$mid
            ];
            $project = $this->isMember($data);
            if($project){

                $project->members()->detach($data['user_id']);

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
}