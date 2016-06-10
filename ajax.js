var xslDoc;   
var xmlDoc;  
var xmlText;  
var xslText;  
var xmlHttpObj;
var sortKey = "title";
var sortType = "text";
var sortOrder = "ascending";

function CreateXmlHttpRequestObject()
{
    var xmlObj;
    if (window.ActiveXObject)
    {     
        try
        {
           xmlObj = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        catch (e)
        {
           xmlObj = new ActiveXObject("Msxml2.XMLHTTP");
        }        
    }
    else
    {        
        xmlObj = new XMLHttpRequest();
    }        
    return xmlObj;
}

function getStyleSheet()
{
    xmlHttpObj = CreateXmlHttpRequestObject();    
    xmlHttpObj.open("GET", "stylexsl.xsl", false);
    xmlHttpObj.send(null);
    if (xmlHttpObj.status == 200)
    {
        xslDoc = xmlHttpObj.responseXML; 
        xslText = xmlHttpObj.responseText;
    }
    else
    { 
        alert("error loading stylesheet " + xmlHttpObj.status);
    }    
}

function getDataFile()
{
    xmlHttpObj = CreateXmlHttpRequestObject();    
    xmlHttpObj.open("GET", "ajax.xml", false);
    xmlHttpObj.send(null);
    if (xmlHttpObj.status == 200)
    {
        xmlDoc = xmlHttpObj.responseXML;
        xmlText = xmlHttpObj.responseText;
    }
    else
    {
        alert("error loading data file " + xmlHttpObj.status);
    }
}

function doTranslation()
{
    try
    {
        var processor = new XSLTProcessor();
        processor.importStylesheet(xslDoc);
        processor.setParameter(null, "sortKey", sortKey);
        processor.setParameter(null, "sortOrder", sortOrder);
        processor.setParameter(null, "sortType", sortType);
        var newDocument = processor.transformToDocument(xmlDoc);
        document.getElementById("disp").innerHTML = new XMLSerializer().serializeToString(newDocument);        
    } catch (e)
    {   
        // Load XSL
        var objXSLT = new ActiveXObject("MSXML2.FreeThreadedDomDocument");
        objXSLT.loadXML(xslText);

        // create a compiled XSL-object
        var objCompiled = new ActiveXObject("MSXML2.XSLTemplate");
        objCompiled.stylesheet = objXSLT.documentElement;
				
        // create XSL-processor
        var objXSLProc = objCompiled.createProcessor();

        // Load your XML
        var objXML = new ActiveXObject("MSXML2.FreeThreadedDomDocument");
        objXML.loadXML(xmlText);

        // input for XSL-processor
        objXSLProc.input = objXML;
        objXSLProc.addParameter("sortKey", sortKey);
        objXSLProc.addParameter("sortOrder", sortOrder);
        objXSLProc.addParameter("sortType", sortType);
			
        // transform
        objXSLProc.transform();

        // display
        document.getElementById("disp").innerHTML = objXSLProc.output;           
    }           
}

function reSort(which)
{
    if (sortKey == which)
    {
        sortOrder = (sortOrder == "ascending") ? "descending" : "ascending";
    }
    else
    {
        sortKey = which;        
        sortOrder = "ascending";
    }      
    sortType = (sortKey == "zwyciestwa" || sortKey == "popularnosc") ? "number" : "text";      
    doTranslation();
}

function initialize()
{
    getStyleSheet();
    getDataFile();
    doTranslation();
}    