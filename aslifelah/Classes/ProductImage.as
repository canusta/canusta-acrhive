package 
{
	
	import canusta.data.*;
	import canusta.gui.*
	import flash.display.*;
	import flash.utils.*;
	import flash.net.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import caurina.transitions.*;
	import SWFAddress;
	import SWFAddressEvent;

	public class ProductImage extends MovieClip
	{
		
		private var global				: Global = Global.getInstance();
		private var _url				: String;
		private var image				: MovieClip = new MovieClip();
		private var maskmc				: MovieClip = new MovieClip();
		public var stat					: Boolean = false;
		public var imagestat			: Boolean = false;
		private var direction			: String;
	
		public function ProductImage(purl:String):void
		{
			
			_url = purl;
			init();
			
		}
		
		private function init():void
		{
			
			
			
		}
		
		private function addMask():void
		{
			
			addChild(maskmc);
			var square : Sprite = new Sprite();
			maskmc.addChild(square);
			maskmc.x = 500;
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0xFF0000);
			square.graphics.drawRect(0,0,1,image.height);
			square.graphics.endFill();
			image.mask = maskmc;
			
		}
		
		public function loadImage()
		{
			
			var loader = new Loader();
			var imageRequest : URLRequest = new URLRequest('../Images/'+_url);
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, imageloaded);
			loader.load(imageRequest);
			
		}
		
		private function imageloaded(e:Event)
		{
			
			addChild(image);
			//image.alpha = 0;
			image.addChild(e.target.content);
			addMask();
			dispatchEvent(new Event("imageloaded"));
			imagestat = true;
			if(stat==true)
			{
				launch(direction);
			}
			
		}
		
		public function launch(pdirection:String)
		{
			
			direction = pdirection;
			stat=true;
			if(imagestat==true)
			{
				
				if(direction=='fromRight')
				{
					image.x = 100;
					maskmc.x = 500;
					Tweener.addTween( image, { x: 0 , time:1 , transition:"easeOutExpo"} );
					Tweener.addTween( maskmc, { x: 0 , time:1 , transition:"easeOutExpo"} );
					Tweener.addTween( maskmc, { width: image.width , time:1 , transition:"easeOutExpo"} );
				}
				if(direction=='fromLeft')
				{
					image.x = -100;
					maskmc.x = 0;
					Tweener.addTween( image, { x: 0 , time:1 , transition:"easeOutExpo"} );
					Tweener.addTween( maskmc, { x: 0 , time:1 , transition:"easeOutExpo"} );
					Tweener.addTween( maskmc, { width: image.width , time:1 , transition:"easeOutExpo"} );
				}
				
			}
			
		}
		
		public function delaunch(direction:String)
		{
			
			stat = false;
			if(direction=='toLeft')
			{
				
				Tweener.addTween( image, { x: -100 , time:1 , transition:"easeOutExpo"} );
				Tweener.addTween( maskmc, { width: 0 , time:1 , transition:"easeOutExpo"} );
				
			}
			if(direction=='toRight')
			{
				
				Tweener.addTween( image, { x: 100 , time:1 , transition:"easeOutExpo"} );
				Tweener.addTween( maskmc, { width: 0 , time:1 , transition:"easeOutExpo"} );
				Tweener.addTween( maskmc, { x: 500 , time:1 , transition:"easeOutExpo"} );
				
			}
		}
		
	}

}

