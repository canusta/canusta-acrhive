/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import flash.text.*;
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
	import canusta.text.*;
	
	public class Product extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var xml								: Object;
		private var imageurl						: String;
		private var imagewidth						: Number;
		private var brandlogo						: String;
		private var productname						: String;
		private var propertynames					: Array;
		private var propertycontents				: Array;
		private var brandlink						: String;
		private var gallery0						: Array;
		private var gallery1						: Array;
		private var gallery2						: Array;
		private var galleries						: Array;
		private var backbutton						: MovieClip;
		private var gallery							: MovieClip;
		private var brandlinkarrowx					: Number;
		private var backbttnlabel					: String;
		public var currentgallerybttn				: GalleryButton;
		
		public function Product(pxml:Object):void
		{
			
			global.yachtsmode = 1;
			
			
			
			xml = pxml;
			productthumbnail_mc.alpha = 0;
			//logo.alpha = 0;
			imageurl = xml[0].thumbnail;
			imagewidth = xml[0].thumbnail.@width;
			brandlogo = global.db[0].productlabels.*[xml[0].category].@thumbnail;
			productname = xml[0].name;
			propertynames = new Array();
			propertynames.push(global.db[0].staticnames.yacht.*[0]);
			propertynames.push(global.db[0].staticnames.yacht.*[1]);
			propertynames.push(global.db[0].staticnames.yacht.*[2]);
			propertynames.push(global.db[0].staticnames.yacht.*[3]);
			propertycontents = new Array();
			for ( var i in xml[0].property ){propertycontents.push(xml[0].property.*[i])}
			brandlink = xml[0].link;	
			galleries = new Array();		
			gallery0 = new Array();
			gallery0 = [xml[0].gallery.(@category=='0').*];
			galleries.push(gallery0);
			gallery1 = new Array();
			gallery1 = [xml[0].gallery.(@category=='1').*];
			galleries.push(gallery1);
			gallery2 = new Array();
			gallery2 = [xml[0].gallery.(@category=='2').*];
			galleries.push(gallery2);
			backbttnlabel = global.db[0].staticnames.yacht.item.(@ids=='back');
			backbttn_mc.y = 112;
			init();
			
		}
		
		private function init():void {
			
			global.root.whitebg.launch();
			addproductthumbnail();
			openbackbttn();
			addproductname();
			addproperty();
			addlink();
			addlogo();
			addGalleryButton();
			
		}
		
		private function addGalleryButton():void
		{
			
			var gallerybutton1 : GalleryButton = new GalleryButton( 0, global.db[0].staticnames.yacht.item.(@ids=='exterior'), this);
			gallerybutton1.alpha = 0;
			gallerybuttons_mc.addChild(gallerybutton1);
			gallerybutton1.over();
			gallerybutton1.clicked();
			Tweener.addTween( gallerybutton1, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: 0.8});
			var gallerybutton2 : GalleryButton = new GalleryButton( 1, global.db[0].staticnames.yacht.item.(@ids=='interior'), this);
			gallerybutton2.alpha = 0;
			gallerybuttons_mc.addChild(gallerybutton2);
			Tweener.addTween( gallerybutton2, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: 1});
			gallerybutton2.y = 28;
			var gallerybutton3 : GalleryButton = new GalleryButton( 2, global.db[0].staticnames.yacht.item.(@ids=='layout'), this);
			gallerybutton3.alpha = 0;
			gallerybuttons_mc.addChild(gallerybutton3);
			Tweener.addTween( gallerybutton3, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: 1.2});
			gallerybutton3.y = 56;
			
		}
		
		private function addlink() {
			
			var txt : LeituraSansGrot3 = new LeituraSansGrot3();
			txt.s.setStyle("s", {color:'#383838', fontSize:10, letterSpacing:1});
			brandlink_mc.addChild(txt);
			txt.txt.htmlText = "<s>" + brandlink + "</s>";
			txt.y += 30;
			txt.alpha = 0;
			txt.txt.antiAliasType = AntiAliasType.ADVANCED;
			brandlinkarrowx = Math.round(txt.txt.width);
			brandlink_mc.arrow_mc.x = brandlinkarrowx;
			brandlink_mc.arrow_mc.alpha = 0;
			Tweener.addTween( txt, { y: txt.y-25 , time:2 , transition:"easeOutExpo", delay: 0.6} );
			Tweener.addTween( txt, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: 0.6});
			var _underline : Underline = new Underline(txt.txt.width-4);
			txt.addChild(_underline);
			_underline.y = 10;
			_underline.x = -1;
			buttonizelink();
		}
		
		private function buttonizelink() {
			
			brandlink_mc.addEventListener(MouseEvent.CLICK, brandlinkclick);
			brandlink_mc.addEventListener(MouseEvent.MOUSE_OVER, brandlinkover);
			brandlink_mc.addEventListener(MouseEvent.MOUSE_OUT, brandlinkout);
			
		}
		
		private function brandlinkclick(e:Event)
		{
			
			var request:URLRequest = new URLRequest("http://"+brandlink);
			navigateToURL(request, '_blank');
			
		}
		
		private function brandlinkover(e:Event)
		{
			
			Tweener.addTween( brandlink_mc.arrow_mc, { x: brandlinkarrowx+5 , time:1 , transition:"easeOutExpo"});
			Tweener.addTween( brandlink_mc.arrow_mc, { alpha: 1 , time:1 , transition:"easeOutExpo"});
			
		}
		
		private function brandlinkout(e:Event)
		{
			
			Tweener.addTween( brandlink_mc.arrow_mc, { x: brandlinkarrowx , time:1 , transition:"easeOutExpo"});			
			Tweener.addTween( brandlink_mc.arrow_mc, { alpha: 0 , time:1 , transition:"easeOutExpo"});			
			
		}
		
		private function addproperty()
		{
			
			for ( var i in propertynames )
			{
				var txt : LeituraSansGrot3 = new LeituraSansGrot3();
				txt.s.setStyle("s", {color:'#CDCDCD', fontSize:12, letterSpacing:0});
				propertynames_mc.addChild(txt);
				txt.y = i * 20;
				//txt.txt.setTextFormat(tctS);
				txt.txt.htmlText = "<s>" + propertynames[i] + "</s>";
				txt.txt.y = 25;
				txt.txt.alpha = 0;
				txt.txt.antiAliasType = AntiAliasType.ADVANCED;
				Tweener.addTween( txt.txt, { y: 0 , time:2 , transition:"easeOutExpo", delay: i/8} );
				Tweener.addTween( txt.txt, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: i/8});
			}
			
			for ( var ii in propertynames )
			{
				var txt2 : LeituraSansGrot3 = new LeituraSansGrot3();
				txt2.s.setStyle("s", {color:'#383838', fontSize:12, letterSpacing:0});
				propertynames_mc.addChild(txt2);
				txt2.y = ii * 20;
				txt2.x = 98;
				if(global.lang=="it"){txt2.x = 138;}
				//txt.txt.setTextFormat(tctS);
				txt2.txt.htmlText = "<s>" + xml.property.*[ii] + "</s>";
				txt2.txt.y = 25;
				txt2.txt.alpha = 0;
				txt2.txt.antiAliasType = AntiAliasType.ADVANCED;
				Tweener.addTween( txt2.txt, { y: 0 , time:2 , transition:"easeOutExpo", delay: ii/8});
				Tweener.addTween( txt2.txt, { alpha: 1 , time:2 , transition:"easeOutExpo", delay: ii/8} );
			}
			
		}
		
		private function addproductname()
		{
			
			var txt : LeituraSansGrot2 = new LeituraSansGrot2();
			productname_mc.txt_mc.addChild(txt);
			
			txt.s.setStyle("s", {color:'#636363', fontSize:24, letterSpacing:-1});
			txt.txt.htmlText = "<s>" + productname + "</s>"; 
			productname_mc.mask_mc.width = productname_mc.txt_mc.width + 10;
			productname_mc.mask_mc.height = productname_mc.txt_mc.height;
			
		}
		
		private function addlogo() {
			
			var loader = new Loader();
			var imageRequest : URLRequest = new URLRequest("../Images/"+brandlogo);
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, logoloaded);
			loader.load(imageRequest);
			
		}
		
		private function logoloaded(e:Event):void
		{
			
			logo.image_mc.addChild(e.target.content);
			logo.mask_mc.width = logo.image_mc.width;
			logo.mask_mc.height = logo.image_mc.height;
			logo.image_mc.y = logo.image_mc.height;
			Tweener.addTween( logo.image_mc, { y: 0 , time:1 , transition:"easeOutExpo", onComplete:function(){bckmask_mc.height=80;}} );
			Tweener.addTween( logo, { alpha: 1 , time:4 , transition:"easeOutExpo"} );
			Tweener.addTween( productname_mc, { y: logo.image_mc.height + logo.y + 13 , time:1 , transition:"easeOutExpo"} );
			propertynames_mc.y = productname_mc.txt_mc.height + productname_mc.y + 40;
			
		}
		
		private function openbackbttn()
		{
			
			backbttn_mc.hover_mc.txt.autoSize = backbttn_mc.txt.autoSize = TextFieldAutoSize.RIGHT;
			backbttn_mc.hover_mc.txt.text = backbttn_mc.txt.text = backbttnlabel;
			backbttn_mc.arrow_mc.x = Math.round(backbttn_mc.txt.x)-3;
			backbttn_mc.hover_mc.bg.width = Math.round(backbttn_mc.hover_mc.txt.width) + 30;
			backbttn_mc.hover_mc.bg.x = Math.round(backbttn_mc.hover_mc.txt.x) - 20;
			backbttn_mc.hover_mc.arrow_mc.x = Math.round(backbttn_mc.hover_mc.txt.x) - 10;
			Tweener.addTween( backbttn_mc, { y: 92 , time:1 , transition:"easeOutExpo", onComplete:function(){bckmask_mc.height=80;}} );
			backbttn_mc.addEventListener(MouseEvent.CLICK, backclick);
			backbttn_mc.addEventListener(MouseEvent.MOUSE_OVER, backover);
			backbttn_mc.addEventListener(MouseEvent.MOUSE_OUT, backout);
			
		}
		
		private function backclick(e:Event):void
		{
			global.root.nextlink = '/yachts/';
			transout();
		}
		
		private function backover(e:Event):void
		{
			Tweener.addTween( backbttn_mc.hover_mc, { alpha: 1 , time:1 , transition:"easeOutExpo"} );
		}
		
		private function backout(e:Event):void
		{
			Tweener.addTween( backbttn_mc.hover_mc, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
		}
		
		private function addproductthumbnail()
		{
			
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
			productthumbnail_mc.addChild(image);
			global.root.playSound();
			
		}
		
		private function reflectionloaded(e:Event)
		{
			
			var image : DisplayObject = e.target.content;
			productthumbnail_mc.reflection_mc.sea_mc.width = image.width;
			productthumbnail_mc.reflection_mc.sea_mc.height = image.height;
			productthumbnail_mc.reflection_mc.image_mc.y = productthumbnail_mc.reflection_mc.sea_mc.y;
			productthumbnail_mc.reflection_mc.seatop_mc.width = productthumbnail_mc.reflection_mc.sea_mc.width + 20;
			productthumbnail_mc.reflection_mc.seatop_mc.y = productthumbnail_mc.reflection_mc.sea_mc.y + productthumbnail_mc.reflection_mc.sea_mc.height;
			productthumbnail_mc.reflection_mc.x = 35;
			productthumbnail_mc.reflection_mc.y = ( 111  - 42 + productthumbnail_mc.reflection_mc.height) ;
		//	image.y = ( 111 - image.height ) - 30;
		//	reflection_mc.image_mc.height = reflection_mc.image_mc.height/2;
			productthumbnail_mc.reflection_mc.image_mc.addChild(image);
			thumbnailmask_mc.width = global.sw-216;
			productthumbnail_mc.x = 0 - ( imagewidth + 94 );
			productthumbnail_mc.alpha = 1;
			Tweener.addTween( productthumbnail_mc, { x:216  , time:2 , transition:"easeOutExpo", delay:0} );
			
		}
		
		public function openGallery(id:Number)
		{
			var children:Array = new Array();
			for (var i=0; i<productgallery_mc.numChildren; i++)
			{
			    children.push(productgallery_mc.getChildAt(i));
			}
			for (i=0; i<children.length; i++)
			{
			    children[i].parent.removeChild(children[i]);
			}
			var newgallery : ProductGallery = new ProductGallery(galleries[id]);
			productgallery_mc.addChild(newgallery);
			
		}
		
		public function transout()
		{
			
			global.yachtsmode = 0;
			Tweener.addTween( backbttn_mc, { y:-50 , time:1 , transition:"easeInExpo"} );
			Tweener.addTween( productthumbnail_mc, { x:global.sw  , time:0.5 , transition:"easeInExpo"} );
			Tweener.addTween( thumbnailmask_mc, { width:0  , time:1 , transition:"easeInExpo", onComplete:function(){global.root.changelink();}, delay:0} );
			Tweener.addTween( thumbnailmask_mc, { x:0  , time:0.5 , transition:"easeOutExpo", delay:1} );
			Tweener.addTween( logo.image_mc, { x:logo.image_mc.width , time:1 , transition:"easeInExpo", onComplete:function(){bckmask_mc.height=80;}} );
			Tweener.addTween( logo.image_mc, { alpha:0 , time:1 , transition:"easeInExpo", onComplete:function(){bckmask_mc.height=80;}} );
			global.root.whitebg.delaunch(1);
			
		}
		
	}
	
}