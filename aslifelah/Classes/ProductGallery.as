package 
{
	
	import canusta.data.*;
	import canusta.gui.*
	import flash.display.*;
	import flash.utils.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import caurina.transitions.*;
	import SWFAddress;
	import SWFAddressEvent;

	public class ProductGallery extends MovieClip
	{
		
		private var global				: Global = Global.getInstance();
		private var db					: Array;
		private var imagedb				: Array = new Array();
		private var currentimage		: Number = 0;
		private var loadedimage			: Number = 0;
	
		public function ProductGallery(pdb:Array):void
		{
			
			db = pdb;
			bttnright.alpha = bttnleft.alpha = 0;
			init();
			
		}
		
		private function init():void
		{
			
		//	Tweener.addTween( bg, { width: 500 , time:0.5 , transition:"easeOutExpo"} );
			
			for ( var i in db[0].*)
			{
				
				var image : ProductImage = new ProductImage(db[0].*[i]);
				imagehere.addChild(image);
				imagedb.push(image);
				
			}
			
			loadImage();
			
		}
		
		private function loadImage()
		{
			
			if(imagedb[loadedimage])
			{
				imagedb[loadedimage].loadImage();
				imagedb[loadedimage].addEventListener('imageloaded', loadnext);
			}
			
		}
		
		private function loadnext(e:Event)
		{
			
			if(loadedimage==0)
			{
				launchbttns();
				imagedb[loadedimage].launch('fromRight');
				//Tweener.addTween( bg, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
				
			}
			
			loadedimage++;
			loadImage();
			
		}
		
		private function launchbttns() {
			
			bttnleft.bg.height = imagedb[loadedimage].height;
			bttnleft.bttn.y = Math.round(( imagedb[loadedimage].height - bttnleft.bttn.height ) / 2);
			bttnright.bg.height = imagedb[loadedimage].height;
			bttnright.bttn.y = Math.round(( imagedb[loadedimage].height - bttnright.bttn.height ) / 2);
			Tweener.addTween( bttnright, { alpha: 1 , time:1 , transition:"easeOutExpo"} );
			buttonize();
			
		}
		
		private function buttonize()
		{
			
			bttnright.bg.addEventListener(MouseEvent.CLICK, rightclick);
			bttnleft.bg.addEventListener(MouseEvent.CLICK, leftclick);
			bttnright.bg.addEventListener(MouseEvent.MOUSE_OVER, mover);
			bttnright.bg.addEventListener(MouseEvent.MOUSE_OUT, mout);
			bttnleft.bg.addEventListener(MouseEvent.MOUSE_OVER, mover);
			bttnleft.bg.addEventListener(MouseEvent.MOUSE_OUT, mout);
			
		}
		
		private function mover(e:Event)
		{
			
			Tweener.addTween( e.currentTarget.parent.bttn.bg, { width: 45 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( e.currentTarget.parent.bttn.bg, { x: -10 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
		private function mout(e:Event)
		{
			
			Tweener.addTween( e.currentTarget.parent.bttn.bg, { width: 35 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( e.currentTarget.parent.bttn.bg, { x: 0 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
		private function rightclick(e:Event)
		{
			
			if(imagedb[currentimage+1] && imagedb[currentimage].imagestat==true)
			{
				
				imagedb[currentimage].delaunch('toRight');
				currentimage++;
				imagedb[currentimage].launch('fromRight');
				
				Tweener.addTween( bttnleft, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
				if(!imagedb[currentimage+1])
				{
					
					Tweener.addTween( bttnright, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
					
				}
				
			}
			
			clicked(e.currentTarget.parent.bttn.bg);
			
		}
		
		private function leftclick(e:Event)
		{

			if(imagedb[currentimage-1])
			{

				imagedb[currentimage].delaunch('toLeft');
				currentimage--;
				imagedb[currentimage].launch('fromLeft');

				Tweener.addTween( bttnright, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
				if(!imagedb[currentimage-1])
				{

					Tweener.addTween( bttnleft, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );

				}

			}
			
			clicked(e.currentTarget.parent.bttn.bg);

		}
		
		private function clicked(bttnbg:MovieClip)
		{
			
			bttnbg.width = 50;
			bttnbg.x = -15;
			Tweener.addTween( bttnbg, { width: 45 , time:0.5 , transition:"easeOutBack"} );
			Tweener.addTween( bttnbg, { x: -10 , time:0.5 , transition:"easeOutBack"} );
			
		}
		
	}

}

