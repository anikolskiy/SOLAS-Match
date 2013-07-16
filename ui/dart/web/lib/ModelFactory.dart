library SolasMatchDart;

import "models/Badge.dart";
import "models/Country.dart";
import "models/Task.dart";
import "models/Tag.dart";
import "models/Locale.dart";
import "models/Org.dart";
import "models/Project.dart";
import "models/Language.dart";
import "models/User.dart";
import "models/UserPersonalInformation.dart";

class ModelFactory
{
  static Badge generateBadgeFromMap(Map data)
  {
    Badge badge = new Badge();
    badge.id = data['id'];
    badge.title = data['title'];
    badge.description = data['description'];
    badge.owner_id = data['owner_id'];
    return badge;
  }
  
  static Country generateCountryFromMap(Map data)
  {
    Country country = new Country();
    country.id = data['id'];
    country.code = data['code'];
    country.name = data['name'];
    return country;
  }
  
  static Organisation generateOrgFromMap(Map orgData)
  {
    Organisation org = new Organisation();
    org.id = orgData['id'];
    org.name = orgData['name'];
    org.biography = orgData['biography'];
    org.homepage = orgData['homepage'];
    org.email = orgData['email'];
    org.address = orgData['address'];
    org.city = orgData['city'];
    org.country = orgData['country'];
    org.regionalFocus = orgData['regionalFocus'];
    return org;
  }
  
  static Project generateProjectFromMap(Map projectData)
  {
    Project project = new Project();
    project.id = projectData['id'];
    project.title = projectData['title'];
    project.description = projectData['description'];
    project.deadline = projectData['deadline'];
    project.organisationId = projectData['organisationId'];
    project.impact = projectData['impact'];
    project.reference = projectData['reference'];
    project.wordCount = projectData['wordCount'];
    project.createdTime = projectData['createdTime'];
    project.status = projectData['status'];
    project.sourceLocale = ModelFactory.generateLocaleFromMap(projectData['sourceLocale']);
    return project;
  }
  
  static Tag generateTagFromMap(Map tagData)
  {
    Tag tag = new Tag();
    tag.id = tagData['id'];
    tag.label = tagData['label'];
  }
  
  static Task generateTaskFromMap(Map taskData)
  {
    Task task = new Task();
    task.id = taskData["id"];
    task.projectId = taskData["projectId"];
    task.wordCount = taskData["wordCount"];
    task.taskType = taskData["taskType"];
    task.taskStatus = taskData["taskStatus"];
    task.title = taskData["title"];
    task.comment = taskData["comment"];
    task.deadline = taskData["deadline"];
    task.createdTime = taskData["createdTime"];
    task.published = taskData["published"] == "1";
    task.sourceLocale = ModelFactory.generateLocaleFromMap(taskData["sourceLocale"]);
    task.targetLocale = ModelFactory.generateLocaleFromMap(taskData["targetLocale"]);
    return task;
  }
  
  static User generateUserFromMap(Map userData)
  {
    User user = new User();
    user.id = userData['id'];
    user.display_name = userData['display_name'];
    user.email = userData['email'];
    user.password = userData['password'];
    user.biography = userData['biography'];
    user.nonce = userData['nonce'];
    user.created_time = userData['created_time'];
    user.nativeLocale = ModelFactory.generateLocaleFromMap(userData['nativeLocale']);
    return user;
  }
  
  static UserPersonalInformation generateUserInfoFromMap(userData)
  {
    UserPersonalInformation userInfo = new UserPersonalInformation();
    userInfo.id = userData['id'];
    userInfo.userId = userData['userId'];
    userInfo.firstName = userData['firstName'];
    userInfo.lastName = userData['lastName'];
    userInfo.mobileNumber = userData['mobileNumber'];
    userInfo.businessNumber = userData['businessNumber'];
    userInfo.sip = userData['sip'];
    userInfo.jobTitle = userData['jobTitle'];
    userInfo.address = userData['address'];
    userInfo.city = userData['city'];
    userInfo.country = userData['country'];
    return userInfo;
  }
  
  static Language generateLanguageFromMap(Map languageData)
  {
    Language language = new Language();
    language.id = languageData['id'];
    language.name = languageData['name'];
    language.code = languageData['code'];
    return language;
  }
  
  static Locale generateLocaleFromMap(Map localeData)
  {
    Locale locale = new Locale();
    locale.languageName = localeData["languageName"];
    locale.languageCode = localeData["languageCode"];
    locale.countryName = localeData["countryName"];
    locale.countryCode = localeData["countryCode"];
    return locale;
  }
}