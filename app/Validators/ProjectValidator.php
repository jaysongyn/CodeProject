<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 04:59
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        'due_date' => 'required|date',
        'status' => 'required'
    ];
}