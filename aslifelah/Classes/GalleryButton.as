/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import lt.uza.utils.*
	import caurina.transitions.*;
	import flash.text.*;
	
	public class GalleryButton extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var lbl								: String;
		private var stat							: Boolean = false;
		private var product							: Product;
		private var id								: Number;
		
		public function GalleryButton(pid:Number, plbl:String, pproduct:Product):void
		{
			
			lbl = plbl;
			product = pproduct;
			id = pid;
			bg.width = 1;
			bg.alpha = 0;
			txtwhite.alpha = 0;
			arrow_mc.alpha = 0;
			init();
			
			
			
		}
		
		private function init():void {
			
			txtwhite.autoSize = txt.autoSize = TextFieldAutoSize.LEFT;
			txtwhite.text = txt.text = lbl;
			
			bttn_mc.width = txt.width+14;
			
			bttn_mc.addEventListener(MouseEvent.MOUSE_OVER, over);
			bttn_mc.addEventListener(MouseEvent.MOUSE_OUT, out);
			bttn_mc.addEventListener(MouseEvent.CLICK, clicked);
			
			
			
		}
		
		public function over(e:Event=null)
		{
			
			if(stat==false)
			{
				bg.alpha = 1;
				Tweener.addTween( bg, { width: txt.width+14 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txt, { x: 7 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txt, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txtwhite, { x: 7 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txtwhite, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
			}
			
			trace('hoy')
			
		}
		
		private function out(e:Event=null)
		{
			if(stat==false)
			{
				Tweener.addTween( bg, { width: 1 , time:0.5 , transition:"easeOutExpo", onComplete:function(){bg.alpha=0}} );
				Tweener.addTween( txt, { x: 0 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txt, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txtwhite, { x: 0 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( txtwhite, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			}
		}
		
		public function clicked(e:Event=null)
		{
			if(product.currentgallerybttn)
			{
				product.currentgallerybttn.delaunch();
			}
			product.openGallery(id);
			stat=true;
			product.currentgallerybttn = this;
			arrow_mc.alpha = 1;
			arrow_mc.x = txt.width + 4;
			Tweener.addTween( bg, { width: 1 , time:0.5 , transition:"easeOutExpo", onComplete:function(){bg.alpha=0}} );
			Tweener.addTween( txt, { x: 0 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( txt, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( txtwhite, { x: 0 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( txtwhite, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
		}
		
		public function delaunch()
		{
			
			stat = false;
			out();
			Tweener.addTween( arrow_mc, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
		}
		
	}
	
}