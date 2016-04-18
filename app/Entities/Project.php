<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'owner_id',
		'client_id',
		'name',
		'description',
		'progress',
		'status',
		'due_date',
	];

	public  function setDueDateAttribute($value) {

		$date= explode('/', $value);
		if(isset($date[2]))
			$this->attributes['due_date'] = $date[2] ."-".$date[1] ."-".$date[0];
		else
			$this->attributes['due_date'] = $value;
	}

	public function getDueDateAttribute($value){
		return date('d/m/Y', strtotime($value));
	}

	public function owner()
	{
		return $this->belongsTo(User::class);
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
	public function notes()
	{
		return $this->hasMany(ProjectNote::class);
	}

	public function tasks()
	{
		return $this->hasMany(ProjectTask::class);
	}

	public function members()
	{
		return $this->belongsToMany(User::class,'project_members','project_id', 'user_id');
	}

	public function files(){

		return $this->hasMany(ProjectFile::class);
	}

}
