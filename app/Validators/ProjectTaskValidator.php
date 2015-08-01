<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 04:59
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required|max:255',
        'status' => 'required',
        'start_date' => 'required|date',
        'due_date' => 'required|date'
    ];
}