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

	public class Gallery extends MovieClip
	{
		
		private var global				: Global = Global.getInstance();
		private var address				: String;
		private var xml					: Object;
		private var productlabels		: Object;
		private var productlabeldb		: Array;
		private var thumbnaildb			: Array;
		private var margintop			: Number = 117; 
		private var bg					: MovieClip = new MovieClip();
	
		public function Gallery(paddress:String, pproductlabels:Object):void
		{
			
			address = paddress;
			productlabels = pproductlabels;
			gatherxml();
			global.root.currentcontent = this;
			global.root.whitebg.delaunch();
			init();
			this.y = -20;
			
		}
		
		private function init():void
		{
			
			//addbg();
			addProductLabels();
			addThumbnails();
			
		}
		
		private function addbg()
		{
			
			addChild(bg);
			bg.alpha = 0;
			var square : Sprite = new Sprite();
			bg.addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0xFFFFFF);
			square.graphics.drawRect(0,0,1,425);
			square.graphics.endFill();
			
		}
		
		private function gatherxml() {
			
			xml = global.db.page.(@lnk==address);
			
		}
		
		private function addProductLabels() {
			
			for(var i in productlabels)
			{
				var productlabel : ProductLabel = new ProductLabel(productlabels[i], productlabels[i].@thumbnail);
				addChild(productlabel);
				productlabel.y = margintop + ( i * 121 );
			}
			
		}
		
		private function addThumbnails() {
			
			thumbnaildb = new Array();
			productlabeldb = new Array();
			
			for ( var i in xml.* )
			{
				
				var productlabel : ProductLabel = new ProductLabel(productlabels[i], productlabels[i].@thumbnail);
				addChild(productlabel);
				productlabel.y = margintop + ( i * 121 );
				productlabeldb.push(productlabel);
				
				var thumbnailcontainer : MovieClip = new MovieClip();
				thumbnailcontainer.x = 216;
				thumbnailcontainer.y = 108 + ( i * 121 );
				addChild(thumbnailcontainer);
				
				var nextthumbnailx : Number = 0;
				
				for ( var e:Number = 0; e<xml.*[i].*.length(); e++)
				
				{
					var gallerythumbnail = new GalleryThumbnail( xml.*[i].*[e].@lnk, xml.*[i].*[e].name, xml.*[i].*[e].thumbnail, xml.*[i].*[e].thumbnail.@width, Number(i)+Number(e), this, productlabel);
					thumbnailcontainer.addChild(gallerythumbnail);
					gallerythumbnail.x = nextthumbnailx;
					nextthumbnailx  = nextthumbnailx + ( 80 + Number(xml.*[i].*[e].thumbnail.@width) );
					thumbnaildb.push(gallerythumbnail);
					
				}
				
			}
			
		}
		
		public function transout()
		{
			
			for ( var i in productlabeldb)
			{
				productlabeldb[i].transout();
			}
			
			for ( var ii in thumbnaildb)
			{
				thumbnaildb[ii].transout();
			}
			
			// Create a new Timer object with a delay of 500 ms
			var myTimer:Timer = new Timer(1000, 1);
			myTimer.addEventListener('timer', changelink);

			// Start the timer
			myTimer.start();
			
		}
		
		private function changelink(e:Event)
		{
			
			global.root.changelink();
			
		}
		
	}

}

