browser = function(params){
	if(params==null)params={};
	if(params.contentsDisplay==null)params.contentsDisplay=document.body;
	if(params.currentPath==null)params.currentPath="";
	if(params.filter==null)params.filter="";
	if(params.loadingMessage==null)params.loadingMessage="Loading...";
	if(params.data==null)params.data="";
	if(params.search==null)params.search="";

	var search=function(){
		if(params.pathDisplay!=null)params.pathDisplay.innerHTML=params.loadingMessage;
		
		var f=typeof(params.filter)=="object"?params.filter.value:params.filter;
		var s=typeof(params.filter)=="object"?params.search.value:params.search;
		var a=new Ajax();
		with (a){
			Method="POST";
			URL=document.getElementById("urlCorrected").value+"searchVid";
			Data="path="+params.currentPath+"&filter="+f+"&data="+params.data+"&s="+s;
			ResponseFormat="json";
			ResponseHandler=showFiles;
			Send();
		}
	}

	var showFiles=function(res){
		if(params.pathDisplay!=null){
			var p=res.currentPath;
			p=p.replace(/^(\.\.\/|\.\/|\.)*/g,"");
			
			if(params.pathDisplay!=null){
				params.pathDisplay.title=p;
				if(params.pathMaxDisplay!=null){
					if(p.length>params.pathMaxDisplay)p="..."+p.substr(p.length-params.pathMaxDisplay,params.pathMaxDisplay);
				}
				params.pathDisplay.innerHTML="[Rt:\] "+p;
			}
		}
		
		params.contentsDisplay.innerHTML="";
		var oddeven="odd";
		
		for (i=0;i<res.contents.length;i++){
			var f=res.contents[i];
			var el=document.createElement("p");
			with(el){
				setAttribute("title",f.fName);
				setAttribute("fPath",f.fPath);
				setAttribute("fType",f.fType);
				className=oddeven + " item ft_"+f.fType;
				innerHTML=f.fName;
			}
			params.contentsDisplay.appendChild(el);
			oddeven=(oddeven=="odd")?"even":"odd";
			el.ondblclick=selectItem;
		}
	}

	var selectItem=function(){
		var ftype=this.getAttribute("fType");
		var fpath=this.getAttribute("fPath");
		var ftitle=this.getAttribute("title");

		if(params.onSelect!=null)params.openFolderOnSelect=params.onSelect({"type":ftype,"path":fpath,"title":ftitle,"item":this},params);
		if(params.openFolderOnSelect==null)params.openFolderOnSelect=true;

		if(ftype=="folder" && params.openFolderOnSelect){
			params.currentPath=fpath;
			search();
		}
	}

	if(params.refreshButton!=null)params.refreshButton.onclick=search;
	search();
}