package canusta.data 
{
	
	import flash.net.*;
	import flash.display.*;
	import flash.events.*;
	
	/**
	* ...
	* @author Can Usta
	*/
	public class SWFLoader extends EventDispatcher
	{
		
		private var file:String;
		public var content:MovieClip;
		
		public function SWFLoader(pfile:String) 
		{
			
			file = pfile;
			run();
			
		}
		
		private function run()
		{
			
			var mLoader:Loader = new Loader();
			var mRequest:URLRequest = new URLRequest(file);
			mLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onCompleteHandler);
			mLoader.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS, onProgressHandler);
			mLoader.load(mRequest);
			
		}
		
		function onCompleteHandler(loadEvent:Event)
		{
			
			content = loadEvent.currentTarget.content;
			dispatchEvent(new Event("loaded"));
			
		}
		
		public function get data():MovieClip
		{
			
			return content;
			
		}
		
		function onProgressHandler(mProgress:ProgressEvent)
		{
			
			var percent:Number = mProgress.bytesLoaded/mProgress.bytesTotal;
			trace(percent);
			
		}
		
	}
	
}