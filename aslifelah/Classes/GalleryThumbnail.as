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

	public class GalleryThumbnail extends MovieClip
	{
		
		private var global				: Global = Global.getInstance();
		private var link				: String;
		private var imageurl			: String;
		private var productname			: String;
		private var imagewidth			: Number;
		private var order				: Number;
		private var gallery 			: Gallery;
		private var productlabel		: ProductLabel;
		private var txt					: LeituraSansGrot3;
		private var intransout			: Boolean = false;
	
		public function GalleryThumbnail(plink:String, pproductname:String, pimageurl:String, pimagewidth:Number, porder:Number, pgallery:Gallery, pproductlabel:ProductLabel):void
		{
			
			link = plink;
			productname = pproductname;
			imageurl = pimageurl;
			imagewidth = pimagewidth;
			order = porder;
			gallery = pgallery;
			productlabel = pproductlabel;
			loadImage();
			addText();
			addButton();
			this.alpha = 0;
			reflection_mc.alpha = 0;
			Tweener.addTween( bttn_mc, { width: imagewidth + 80 , time:1 , transition:"easeOutExpo", delay:order/5} );
			Tweener.addTween( this, { alpha: 1 , time:0.5 , transition:"easeInExpo", delay:order/5} );
			init();
			
		}
		
		private function loadImage() {
			
			var loader = new Loader();
			var imageRequest : URLRequest = new URLRequest("../Images/"+imageurl);
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, imageloaded);
			loader.load(imageRequest);
			
			var loader2 = new Loader();
			var imageRequest2 : URLRequest = new URLRequest("../Images/"+imageurl);
			loader2.contentLoaderInfo.addEventListener(Event.COMPLETE, reflectionloaded);
			loader2.load(imageRequest);
			
		}
		
		private function imageloaded(e:Event) {
			
			var image : DisplayObject = e.target.content;
			image.x = 40;
			image.y = ( 111 - image.height ) - 40;
			image_mc.addChild(image);
			
		}
		
		private function reflectionloaded(e:Event)
		{
			
			var image : DisplayObject = e.target.content;
			reflection_mc.sea_mc.width = image.width;
			reflection_mc.sea_mc.height = image.height;
			reflection_mc.image_mc.y = reflection_mc.sea_mc.y;
			reflection_mc.seatop_mc.width = reflection_mc.sea_mc.width + 20;
			reflection_mc.seatop_mc.y = reflection_mc.sea_mc.y + reflection_mc.sea_mc.height;
			reflection_mc.x = 35;
			reflection_mc.y = ( 111  - 42 + reflection_mc.height) ;
		//	image.y = ( 111 - image.height ) - 30;
		//	reflection_mc.image_mc.height = reflection_mc.image_mc.height/2;
			reflection_mc.image_mc.addChild(image);
			Tweener.addTween( bttn_mc, { alpha: 0 , time:2 , transition:"easeOutExpo", delay:order/5} );
			Tweener.addTween( reflection_mc, { alpha: 1 , time:2 , transition:"easeOutExpo", delay:order/5} );
			
		}
		
		private function addButton() {
			
			//Tweener.addTween( bttn_mc, { width: imagewidth + 80 , time:0.5 , transition:"easeOutExpo"} );
			//bttn_mc.width = imagewidth + 80;
			bttn_mc.addEventListener(MouseEvent.CLICK, bttnclick);
			bttn_mc.addEventListener(MouseEvent.MOUSE_OVER, bttnover);
			bttn_mc.addEventListener(MouseEvent.MOUSE_OUT, bttnout);
			
		}
		
		private function bttnclick(e:Event)
		{
			
			global.root.nextlink = link;
			global.root.currentcontent.transout();
			
		}
		
		private function bttnover(e:Event)
		{
			
			if (intransout==false) {
				productlabel.show();
				txt.alpha = 0;
				Tweener.addTween( txt, { alpha: 1 , time:4 , transition:"easeOutExpo"} );
				txt.s.setStyle("s", {color:'#636363', fontSize:12, letterSpacing:0});
				txt.txt.htmlText =  "<s>"+productname+"</s>";
			}
			
		}
		
		private function bttnout(e:Event)
		{
			if (intransout==false)
			{
				productlabel.hide();
				txt.alpha = 0;
				Tweener.addTween( txt, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
				txt.s.setStyle("s", {color:'#FFFFFF', fontSize:10, letterSpacing:1});
				txt.txt.htmlText =  "<s>"+productname+"</s>";
			}
		}
		
		private function addText()
		{
			
			txt = new LeituraSansGrot3();
			txt.s.setStyle("s", {color:'#FFFFFF', fontSize:10, letterSpacing:1});
			txt.txt.htmlText =  "<s>"+productname+"</s>";
			txt.x = 10;
			txt.y = 10;
			txt_mc.addChild(txt);
			
		}
		
		public function transout()
		{
			
			Tweener.addTween( this, { alpha: 0 , time:2 , transition:"easeOutExpo"} );
			
		}
		
	}

}

