library SolasMatchDart;

import 'dart:html';
import 'dart:async';
import "package:web_ui/web_ui.dart";

import "Settings.dart";

class Localisation
{
  static final Localisation _instance = new Localisation._internal();
  static Document doc;
  
  factory Localisation()
  {
    return _instance;
  }
  
  static SafeHtml getTranslationSafe(String key)
  {
    SafeHtml data;
    Element element = doc.query("[name = $key]");
    if (element != null) {
      data = new SafeHtml.unsafe("<span>" + element.text + "</span>");
    } else {
      data = null;
    }
    return data;
  }
  
  static String getTranslation(String key)
  {
    String data;
    Element element = doc.query("[name = $key]");
    if (element != null) {
      data = element.text;
    } else {
      print("Unable to find string with name $key");
      data = '';
    }
    return data;
  }
  
  static Future<bool> loadFile()
  {
    Settings settings = new Settings();
    return HttpRequest.getString(settings.conf.urls.SiteLocation + "static/getStrings/")
      .then((String data) {
        bool ret;
        if (data != "") {
          DomParser parser = new DomParser();
          doc = parser.parseFromString(data, "text/xml");
          ret = true;
        } else {
          ret = false;
        }
        return ret;
      });
  }
  
  Localisation._internal();
}