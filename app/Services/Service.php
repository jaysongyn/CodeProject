<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 29/07/2015
 * Time: 16:52
 */

namespace CodeProject\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;
use Prettus\Validator\Exceptions\ValidatorException;

class Service
{
    /**
     * @var ClientValidator
     */
    protected $validator;
    /**
     * @var ClientRepository
     */
    protected $repository;

    public function __construct($repository, $validator)
    {

        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $with
     * @return array|mixed
     */
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
     * @param $id
     * @param array $with
     * @return array|mixed
     */
    public function show($id, $with = [])
    {

        try{

            return $this->repository->with($with)->find($id);


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


}