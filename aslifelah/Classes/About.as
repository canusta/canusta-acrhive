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
	import caurina.transitions.*;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	
	public class About extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var bg								: MovieClip = new MovieClip();
		private var db								: Object;
		private var columnleftdb					: Array = new Array();
		private var columnleft						: MovieClip;
		private var columnright						: MovieClip;
		private var imagewidth						: Number = 344;
		private var imageleftcontainer				: MovieClip;
		private var imagerightcontainer				: MovieClip;
		
		public function About():void
		{
			
			trace('adadad')
			global.root.currentcontent = this;
			db = global.db.page.(@lnk=='/about/').*;
			this.x = 263;
			this.y = 157;
			init();
			
		}
		
		private function init():void
		{
			
			global.root.whitebg.launch();
			addbg();
			addColumn('left');
			if(db.(@id=='right'))
			{
/*				addColumn('right');*/
			}
			
		}
		
		private function addColumn(side:String)
		{
			
			var container : MovieClip;
			var containerdb : Object = db.(@id==side);
			
			if(side=='left')
			{
				
				columnleft = new MovieClip();
				addChild(columnleft);
				container = columnleft;
				
			}
			
			if(side=='right')
			{
				
				columnright = new MovieClip();
				addChild(columnright);
				container = columnright;
				container.x = 396;
				
			}
			
			/// IMAGE
			
			var image : MovieClip = new MovieClip();
			container.addChild(image);
			var imagebg : MovieClip = new MovieClip();
			image.addChild(imagebg);
			var imageimage : MovieClip = new MovieClip();
			if(side=='left')
			{
				imageleftcontainer = imageimage;
			}else
			{
				imagerightcontainer = imageimage;
			}
			container.addChild(imageimage);
			var preloader:ImagePreloader = new ImagePreloader();
			imagebg.addChild(preloader);
		//	imagebg.x = 179;
		//	imagebg.y = 83;
			imagebg.x = 179;
			imagebg.y = 83;
			/*var square : Sprite = new Sprite();
			imagebg.addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0x383838);
			square.graphics.drawRect(0,0,1,containerdb.image.@height);
			Tweener.addTween( imagebg, { width: imagewidth , time:1 , transition:"easeOutExpo"} );
			//square.graphics.drawRect(0,0,500,500);
			square.graphics.endFill();*/
			//trace(db)
			var loader = new Loader();
			var imageRequest : URLRequest = new URLRequest('../Images/'+containerdb.image);
			if(side=='left')
			{
				loader.contentLoaderInfo.addEventListener(Event.COMPLETE, leftimageloaded);
			}
			if(side=='right')
			{
				loader.contentLoaderInfo.addEventListener(Event.COMPLETE, rightimageloaded);
			}
			loader.load(imageRequest);
			
			/// TEXT
			
			var txt : LeituraSansGrot3 = new LeituraSansGrot3();
			txt.s.setStyle("s", {color:'#636363', fontSize:12, letterSpacing:0, leading:7});
			txt.txt.width = imagewidth;
			txt.txt.embedFonts = true;
			txt.txt.antiAliasType = AntiAliasType.ADVANCED;
			txt.txt.gridFitType = GridFitType.PIXEL;
			txt.txt.wordWrap= true;
			txt.txt.htmlText = "<s>" + containerdb.text + "</s>";
			txt.y = Number(containerdb.image.@height)+51;
			txt.alpha = 0;
			Tweener.addTween( txt, { alpha: 1 , time:1 , transition:"easeOutExpo", delay:1} );
			container.addChild(txt);
			
			// LINK
			
			for ( var i in containerdb.links.*)
			{
				
				var lnk : AboutLink = new AboutLink(containerdb.links.*[i].@lbl, containerdb.links.*[i]);
				lnk.alpha = 0;
				Tweener.addTween( lnk, { alpha: 1 , time:1 , transition:"easeOutExpo", delay:1.2} );
				lnk.y = Math.round( txt.y + txt.height + 15 + ( i * 20 ) );
				container.addChild(lnk);
				
			}
			
		}
		
		private function leftimageloaded(e:Event)
		{
			var image : MovieClip = new MovieClip();
			imageleftcontainer.addChild(image);
			image.addChild(e.target.content);
			var rect : DrawRectangle = new DrawRectangle(0,0,1,imageleftcontainer.height,0x383838);
			imageleftcontainer.addChild(rect);
			imageleftcontainer.mask = rect;
			Tweener.addTween( rect, { width: e.target.content.width , time:1 , transition:"easeOutExpo"} );
			image.x = -50;
			Tweener.addTween( image, { x: 0 , time:1 , transition:"easeOutExpo"} );
			
		}
		
		private function rightimageloaded(e:Event)
		{
			var image : MovieClip = new MovieClip();
			imagerightcontainer.addChild(image);
			image.addChild(e.target.content);
			var rect : DrawRectangle = new DrawRectangle(0,0,1,imagerightcontainer.height,0x383838);
			imagerightcontainer.addChild(rect);
			imagerightcontainer.mask = rect;
			Tweener.addTween( rect, { width: e.target.content.width , time:1 , transition:"easeOutExpo"} );
			image.x = -50;
			Tweener.addTween( image, { x: 0 , time:1 , transition:"easeOutExpo"} );
			
		}
		
		private function addbg()
		{
			
			addChild(bg);
			bg.alpha = 0;
			var square : Sprite = new Sprite();
			bg.addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0xFFFFFF);
			square.graphics.drawRect(0,0,imagewidth,425);
			square.graphics.endFill();
			
		}
		
		public function transout()
		{
			
			global.root.whitebg.delaunch();
			Tweener.addTween( columnright, { alpha: 0 , time:0.2 , transition:"easeOutExpo"} );
			Tweener.addTween( columnleft, { alpha: 0 , time:1 , transition:"easeOutExpo", onComplete:function(){global.root.changelink();}} );
			
		}
		
	}
	
}