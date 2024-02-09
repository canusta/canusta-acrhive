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

public class ItemList extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var db								: String;
	private var firstList						: AList;
	
	public function ItemList(pdb:String)
	{
		
		db = pdb;
		run();
		
	}
	
	private function run():void
	{
		
		firstList = new AList();
		firstList.text = db;
		addChild(firstList);
		
	}
	
}

}

