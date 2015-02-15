<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['text', 'time', 'conversation_id', 'sender_id'];


}