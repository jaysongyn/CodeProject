<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 29/07/2015
 * Time: 16:52
 */

namespace CodeProject\Services;


class Service
{
    /**
     * @var ClientValidator
     */
    private $validator;
    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct($repository, $validator)
    {

        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @return array|mixed
     */
    public function index()
    {
        try{

            return  $this->repository->all();

        }catch (ValidationException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }


    /**
     * @param $id
     * @return array|mixed
     */
    public function show($id)
    {

        try{
            return  $this->repository->find($id);

        }catch (ValidationException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
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

        }catch (ValidationException $e){
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

        }catch (ValidationException $e){
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

        }catch (ValidationException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id)
    {
        try{

            return  $this->repository->find($id)->delete();

        }catch (ValidationException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }


}