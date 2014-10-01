<?php
class Survey extends Eloquent
{
	
	/* Table Stats
	$table->increments('id');
	$table->string('name');
	$table->integer('school_id');
	$table->longText('question_store');
	$table->timestamps();
	*/
	
	protected $guarded = array('id', 'created_at', 'updated_at');
	
	public $timestamps = true;
	
	public function groups()
	{
		return $this->belongsToMany('Group')->withPivot('open_time', 'close_time')->withTimestamps();
	}
	
	public function answers()
	{
		return $this->hasMany('Answer');
	}
	
	public function school()
	{
		return $this->belongsTo('School');
	}
	
	public static function parseQuestionStore($file, $schoolID, $returnFile)
	{
		$file = explode("\n", $file);
		$fileLength = count($file);
		for ($lineI = 0; $lineI < $fileLength; ++$lineI)
		{
			$file[$lineI] = explode("|", $file[$lineI]);
			$lineLength = count($file[$lineI]);
			for($i = 0; $i < $lineLength; ++$i)
			{
				$valueLength = $valueIndex = strlen($file[$lineI][$i]);
				if($valueLength)
				{
					while($file[$lineI][$i][--$valueIndex] == '\\');
					if(($valueLength - $valueIndex + 1)%2)//If the number of \ characters is odd.
					{
						$file[$lineI][$i] = substr($file[$lineI][$i], 0, $valueLength - 1)."|".$file[$lineI][$i+1];
						//Move all of the remaining values back.
						for($innerI = $i+1; $innerI < $lineLength - 1; ++$innerI)
						{
							$file[$lineI][$innerI] = $file[$lineI][$innerI+1];
						}
						array_pop($file[$lineI]);
						--$i;
						--$lineLength;
					}
				}
			}
			//Line has been completed.
			//Does it have 4 entries only?
			if($lineLength != 4)
				return array(false, "Question $lineI must have 4 values.");
			//First is Q?
			if($file[$lineI][0] != "Q")
				return array(false, "The first value of question $lineI must be 'Q'.");
			//All in second value are valid group names for the given schoolID.
			$file[$lineI][1] = explode(',', $file[$lineI][1]);
			$groupsLength = count($file[$lineI][1]);
			$groupRecords = array();
			for($i = 0; $i < $groupsLength; ++$i)
			{
				if(is_null(Group::where('school_id', '=', $schoolID)->where('name', '=', $file[$lineI][1][$i])->first()))
				{
					return array(false, "Question $lineI contains invalid group {$file[$lineI][1][$i]}.");	
				}
				foreach($groupRecords as $groupRecord)
				{
					if($groupRecord == $file[$lineI][1][$i])
						return array(false, "In question $lineI, the group $groupRecord cannot be repeated.");	
				}
				$groupRecords[] = $file[$lineI][1][$i];
			}
			//Check to make sure that the original mark is unique (may not be needed).
		}
		if($returnFile)
			return array(true, $file);
		return array(true);
	}
	
}