﻿package 
{
	import flash.display.MovieClip;
	import flash.text.*;
	
	public class TextFieldAutoscape9pxNowidth extends MovieClip
	{
		
		private var content					: String;
		
		public function TextFieldAutoscape9pxNowidth(pcontent:String) 
		{
			content = pcontent;
			TXT.wordWrap = false;
			TXT.autoSize = TextFieldAutoSize.LEFT;
			TXT.htmlText = content;
		}
		
	}
	
}