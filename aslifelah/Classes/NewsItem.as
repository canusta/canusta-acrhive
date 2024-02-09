/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import canusta.text.*;
	import canusta.shapes.*;
	import flash.display.*;
	import flash.net.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import lt.uza.utils.*
	import caurina.transitions.*;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	
	public class NewsItem extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var _date							: String;
		private var _text							: String;
		private var _link							: String;
		private var _color							: String;
		private var txt								: LeituraSansGrot3;
		
		public function NewsItem(pdate:String, ptext:String, plink:String, pcolor:String='#636363'):void
		{
			
			_date = pdate;
			_text = ptext;
			_link = plink;
			_color = pcolor;
			this.alpha = 0;
			init();
			
		}
		
		private function init():void
		{
			
			global.root.StageResized();
			
			txt = new LeituraSansGrot3;
			txt.s.setStyle("s", {color:_color, fontSize:12, letterSpacing:0, leading:7});
			trace(_color)
			txt.txt.width = 737;
			txt.txt.embedFonts = true;
			//txt.txt.antiAliasType = AntiAliasType.ADVANCED;
			//txt.txt.gridFitType = GridFitType.PIXEL;
			txt.txt.wordWrap= true;
			if(_date!='')
			{
				txt.txt.htmlText = "<s>" + _date + ' - ' + _text + "</s>";
			}else
			{
				txt.txt.htmlText = "<s>" + _text + "</s>";
			}
			addChild(txt);
			Tweener.addTween( this, { alpha:1 , time:4 , transition:"easeOutExpo"} );
			
			if(_link!='')
			{
				addLink()
			}
			
		}
		
		private function addLink() {
			
			var lnk : AboutLink = new AboutLink(_link, _link);
			lnk.y = txt.height;
			addChild(lnk);
			
		}
		
	}
	
}