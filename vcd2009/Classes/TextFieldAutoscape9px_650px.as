﻿package
{
	
	import flash.display.MovieClip;
	import flash.text.*;
	
	public class TextFieldAutoscape9px_650px extends MovieClip
	{
		
		private var content					: String;
		
		public function TextFieldAutoscape9px_650px(pcontent:String) 
		{
			content = pcontent;
			TXT.wordWrap = true;
			TXT.autoSize = TextFieldAutoSize.LEFT;
			TXT.htmlText = content;
		}
		
	}
	
}