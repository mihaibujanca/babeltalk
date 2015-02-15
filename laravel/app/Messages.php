<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['text', 'time', 'conversation_id', 'sender_id'];


}
