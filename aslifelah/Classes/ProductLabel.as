package 
{
	
	import canusta.data.*;
	import canusta.gui.*
	import flash.display.*;
	import flash.net.*;
	import flash.utils.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import caurina.transitions.*;
	import SWFAddress;
	import SWFAddressEvent;

	public class ProductLabel extends MovieClip
	{
		
		private var global				: Global = Global.getInstance();
		private var logourl				: String;
		private var logocontainer		: MovieClip;
		private var products			: MovieClip;
		private var bg					: MovieClip;
		private var bgcontainer			: MovieClip;
		private var thumbnaildb			: Array;
		private var productlabelname	: String;
		private var intransout			: Boolean = false;
	
		public function ProductLabel(pproductlabelname:String, plogourl:String):void
		{
			
			productlabelname = pproductlabelname;
			logourl = plogourl;
			global.root.resizewarning.push(this);
			bgcontainer = new MovieClip();
			addChild(bgcontainer);
			bg = new MovieClip();
			drawbg();
			this.alpha = 0; ///
			bgcontainer.addChild(bg);
			logocontainer = new MovieClip();
			bgcontainer.addChild(logocontainer);
			logocontainer.alpha = 0.5;
			init();
			
		}
		
		private function init():void
		{
			
			var loader = new Loader();
			var imageRequest : URLRequest = new URLRequest("../Images/"+logourl);
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, logoloaded);
			loader.load(imageRequest);
			
		}
		
		private function drawbg():void
		{
			
			var square:Sprite = new Sprite();
			bg.addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0xFFFFFF);
			square.graphics.drawRect(0,0,global.sw,1);
			square.graphics.endFill();
			
		}
		
		private function logoloaded(e:Event=null):void
		{
			
			logocontainer.addChild(e.target.content);
			logocontainer.y = 55 - ( logocontainer.height / 2 );
			logocontainer.x = global.sw - 155;
			StageResized();
			global.root.StageResized();
			
		}
		
		public function StageResized(e:Event=null)
		{
			
			Tweener.addTween( bg, { width: global.sw , time:1 , transition:"easeOutExpo"} );
			Tweener.addTween( logocontainer, { x: global.sw - 155 , time:1 , transition:"easeOutExpo"} );
			
		}
		
		public function show()
		{
			if(intransout==false)
			{
				Tweener.addTween( this, { alpha: 0.9 , time:1 , transition:"easeOutExpo"} );
				Tweener.addTween( bg, { height: 111 , time:1 , transition:"easeOutExpo"} );
			}
		}
		
		public function hide()
		{
			Tweener.addTween( this, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
			Tweener.addTween( bg, { height: 0 , time:1 , transition:"easeOutExpo"} );
		}
		
		public function transout()
		{
			
			hide();
			intransout = true;
			
		}
		
	
	}

}

