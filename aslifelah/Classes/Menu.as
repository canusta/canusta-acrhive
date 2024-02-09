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
	
	public class Menu extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var db								: XML = global.db;
		private var logo							: Logo;
		public var menudb							: Array;
		public var currentpage						: String;
		private var languagebttns					: Array;
		
		public function Menu(pcurrentpage:String):void
		{
			
			currentpage = pcurrentpage;
			global._menu = this;
			global.root.resizewarning.push(this);
			run();
			
		}
		
		public function run():void {
			
			addlogo();
			addmenu();
			
		}
		
		public function switchmenu(lnk:String, menuid:Number){
			
			global.root.switchmenu(lnk, menuid);
			for(var i in menudb)
			{
				if(menudb[i]['id']!=menuid)
				{
					menudb[i]['item'].activate();
				}
			}
			
		}
		
		public function addlogo(e:Event=null):void {
			
			logo = new Logo();
			this.addChild(logo);
			logo.x = 50;
			logo.y = 50;
			
		}
		
		public function addmenu(e:Event=null):void {
			
			menudb = new Array();
			for ( var i : Number = 0; i < db.staticnames.menu.*.length() ; i++)
			{
				var menuactive : Boolean = false;
				if (db.staticnames.menu.*[i].@lnk == currentpage) {
					menuactive = true;
				}
				var menui : MenuItem = new MenuItem( i, db.staticnames.menu.*[i], db.staticnames.menu.*[i].@lnk, db.staticnames.menu.*[i].@typ, menuactive);
				menui.x = 50;
				menui.y = 157 + (i*29);
				this.addChild(menui);
				menudb[i] = {id:i, item:menui, lnk:db.staticnames.menu.*[i].@lnk, typ:db.staticnames.menu.*[i].@typ, xml:db.staticnames.menu.*[i] };
			}
			
		}
		
		public function StageResized(e:Event=null):void{
			
			//LocateLanguageButtons(true);
			
		}
		
		
	}
	
}