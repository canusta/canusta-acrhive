package
{
	
import canusta.data.*;
import flash.utils.*;
import flash.text.*;
import flash.display.*;
import lt.uza.utils.*;
import flash.events.*;
import XMLList;
import Math;
import com.hydrotik.queueloader.QueueLoader;
import com.hydrotik.queueloader.QueueLoaderEvent;
import lt.uza.utils.*
import caurina.transitions.*;
import flash.events.TimerEvent;
import flash.display.Sprite;

public class Findbozca extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var database						: Database;
	private var horecaList						: ItemList;
	private var preakendeList					: ItemList;
	
	public function Findbozca()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		if(global.root)
		{
			global.root.Expand();
		}
		
		loaddatabase();
		
	}
	
	private function loaddatabase(e:Event=null):void {
		
		database = new Database("Database/data.xml");
		database.addEventListener("databaseloaded", countinuerun);
		
	}
	
	private function countinuerun(e:Event=null):void {
		
		global.db = database.data;
		global.database = database;
		//trace(global.db)
		//horecaList = new ItemList('deneme');
		muvi.here.txt1.autoSize = TextFieldAutoSize.LEFT;
		muvi.here.txt2.autoSize = TextFieldAutoSize.LEFT;
		for ( var i in global.db.perakende.* ) {  
		    //muvi.here.txt1.htmlText += global.db.horeca.*[i]+'</br>';   
			muvi.here.txt2.htmlText += global.db.perakende.*[i]+'</br>';   
		}
		
	//	muvi1return();
		muvi2return();
		
		trace(global.db.perakende.*)
		
	}
	
	
	private function muvi1return():void
	{
		
	//	muvi.here.txt1.y = 270;
		Tweener.addTween( muvi.here.txt1, { y: 0-muvi.here.txt1.height-20 , time:30 , transition:"linear", onComplete:muvi1return} );
	//	
	}
	
	private function muvi2return():void
	{
		
		muvi.here.txt2.y = 270;
		Tweener.addTween( muvi.here.txt2, { y: 0-muvi.here.txt2.height-20 , time:30 , transition:"linear", onComplete:muvi2return} );
		
	}
	
}

}

