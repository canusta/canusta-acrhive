/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import canusta.gui.*
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import caurina.transitions.*;
	import SWFAddress;
	import SWFAddressEvent;
	import flash.media.*;
	import flash.net.*;
	
	public class Aslifelah extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var database						: Database;
		public var canvas							: MovieClip;
		private var bg								: MovieClip;
		private var languagebttns					: LanguageBttns;
		public var screenw							: Number;
		public var screenh							: Number;
		public var screenx							: Number;
		public var screeny							: Number;
		public var stagew							: Number = 1200;
		public var stageh							: Number = 700;
		public var _menu							: Menu;
		public var resizewarning					: Array;
		public var currentlnk						: String;
		public var currentpageid					: Number;
		public var linkdb							: Array;
		private var launched						: Boolean = false;
		public var nextlink							: String;
		public var currentcontent					: DisplayObject;
		public var whitebg							: WhiteBg;
		public var lang								: String;
		private var snd								: Sound;
		
		public function Aslifelah()
		{
			
			global.root = this;
			global.trc = trc;
			resizewarning = new Array();
			stage.align = StageAlign.TOP_LEFT;
			//stage.displayState=StageDisplayState.FULL_SCREEN;
			stage.scaleMode = StageScaleMode.NO_SCALE;
			
			var langx : String = this.loaderInfo.parameters.lang;

			if(!langx)
			{
				langx='eng';
			}
			
			//trc.text = langx
			
			lang = langx;
			global.lang = lang;
			
			calculatexy();
			stage.addEventListener(Event.RESIZE, resized);
			whitebg = new WhiteBg();
			addChild(whitebg);
			canvas = new MovieClip();
			addChild(canvas);
			bg = new MovieClip();
			bg.height = 550;
			canvas.addChild(bg);
			this.addEventListener(Event.ADDED_TO_STAGE, run);
			exeSound();
			
		}
		
		private function exeSound():void
		{
			
			snd = new Sound();
			snd.load(new URLRequest("../Sounds/seawave.mp3"));
			
		}
		
		public function playSound():void
		{
			
		    snd.play();
		
		}
		
		public function run(e:Event=null):void {
			this.removeEventListener(Event.ADDED_TO_STAGE, run);
			loaddatabase();
		}
		
		private function loaddatabase(e:Event=null):void {
			
			database = new Database("../Database/Data-" + lang + ".xml");
			database.addEventListener("databaseloaded", countinuerun);
			
		}
		
		private function countinuerun(e:Event=null):void {
			
			global.db = database.data;
			global.database = database;
			loadMenu();
			resized();
			SWFAddress.addEventListener(SWFAddressEvent.CHANGE, addressChange);
			
		}	
		
		public function resized(e:Event=null):void {
			
			calculatexy();
			for(var i in resizewarning)
			{
				resizewarning[i].StageResized();
			}
			StageResized();
			
		}
		
		public function switchmenu(plnk:String, menuid:Number) {
			
			var address : String = plnk;
			SWFAddress.setValue(address);
			
		}
		
		private function loadMenu():void {
			
			calculatexy();
			_menu = new Menu(currentlnk);
			canvas.addChild(_menu);
			languagebttns = new LanguageBttns();
			addChild(languagebttns);
			
		}		
		
		function addressChange(e:Event=null){
			
			var address : String = SWFAddress.getValue();
			
			SWFAddress.setTitle('Aslı Felah | ' + address);
			
			if(address == "/" || address == ''){
				SWFAddress.setValue(global.db.staticnames.menu.*[0].@lnk);
			}
			
			// look in menu
			for(var i in _menu.menudb)
			{
				if (_menu.menudb[i]['lnk'] == address) {
					_menu.menudb[i]['item'].deactivate();
					addContent(_menu.menudb[i]['typ'], address);
				}
			}
			
			// look in yachts
			for(var ii in global.db[0].page.(@lnk=='/yachts/').label.*)
			{
				if (global.db[0].page.(@lnk=='/yachts/').label.*[ii].@lnk == address) {
					addContent(global.db[0].page.(@lnk=='/yachts/').label.*[ii].@typ, address, global.db[0].page.(@lnk=='/yachts/').label.*[ii]);
				}
			}
			
		}
		
		private function addContent(typ:String, address:String, xml:Object=null)
		{
			
			
			
			if(currentcontent)
			{
				canvas.removeChild(currentcontent);
			}
			
			switch (typ)
			{
				case "gallery":
				var gallery : Gallery = new Gallery(address, global.db.productlabels.*);
				canvas.addChild(gallery);
				currentcontent = gallery;
				break;
				case "about":
				var about : About = new About();
				canvas.addChild(about);
				currentcontent = about;
				break;
				case "news":
				var news : News = new News();
				canvas.addChild(news);
				currentcontent = news;
				break;
				case "contact":
				var contact : Contact = new Contact();
				canvas.addChild(contact);
				currentcontent = contact;
				break;
				case "product":
				var product : Product = new Product(xml);
				canvas.addChild(product);
				currentcontent = product;
				break;
			}
			
			StageResized();
			
		}
		
		public function StageResized()
		{
			
			var targety : Number = Math.round( ( ( global.sh - canvas.height ) / 2 ) - 50 );
			if (targety <= 0 ) {
				targety = 0;
			}
			Tweener.addTween( canvas, { y: targety , time:1 , transition:"easeOutExpo"} );
			//canvas.y = targety;
			
		}
		
		private function calculatexy():void
		{
			
			screenw = Math.round(stage.stageWidth);
			screenh = Math.round(stage.stageHeight);
			screenx = Math.round(0 - ( ( screenw - global.stagew) / 2 ));
			screeny = Math.round(0 - ( ( screenh - global.stageh) / 2 ));
			global.sw = screenw;
			global.sh = screenh;
			global.sx = screenx;
			global.sy = screeny;
			
		}
		
		public function changelink():void
		{
			
			SWFAddress.setValue(nextlink);
			
		}
		
	}
	
}