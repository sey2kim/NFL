(function(){YUI.add("hp-user-greet",(function(Y){"use strict";var Constants;Constants=nfl.constants;return Y.namespace("NFL.Header2012").LoadUserGreet=function(){var connected,content,headerNode,provider,providerNode,providers,returnTo,signedInNode,signedOutNode,templateNode,template,toggleProfileLinks,user,_ref,_ref2,_ref3,_ref4,_ref5,_results;headerNode=window.Y.NFL.Header2012.headerNode;user=Y.NFL.User.getCurrent();returnTo="?returnTo="+encodeURIComponent(window.location);if(user){toggleProfileLinks=function(e){var arrowNode,height,linksNode,signedInNode,_ref,_ref2,_ref3,_ref4;signedInNode=e.currentTarget.ancestor("div.signed-in");linksNode=signedInNode.one("div.links");if(!linksNode.slideDown){linksNode.plug(Y.NFL.Header2012.SlideDownPlugin);}
if(!linksNode.slideUp)linksNode.plug(Y.NFL.Header2012.SlideUpPlugin);arrowNode=signedInNode.one("a.arrow-container");if(e.type==="mouseleave"&&!arrowNode.hasClass("active"))return;if(arrowNode.hasClass("active")){if((_ref=signedInNode.one("a.arrow-container"))!=null){_ref.removeClass("active");}
return(_ref2=linksNode.slideUp)!=null?_ref2.run():void 0;}else{if((_ref3=signedInNode.one("a.arrow-container"))!=null){_ref3.addClass("active");}
height=linksNode.getAttribute("data-height");if(!height){height=linksNode.get("offsetHeight");linksNode.setAttribute("data-height",height);}
linksNode.setStyles({height:"0px",visibility:"visible"});return(_ref4=linksNode.slideDown)!=null?_ref4.run(height):void 0;}};signedInNode=headerNode.one("div.signed-in");templateNode=Y.one("#template-signed-in");template=(templateNode&&templateNode.getHTML())||signedInNode.getContent();content=Y.substitute(template,{user:user.get("username")});signedInNode.setContent(content);signedInNode.setStyle("display","block");if((_ref=signedInNode.one("a.profile"))!=null){_ref.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+(user.get("username")));}
if((_ref=signedInNode.one(".user-profile-link"))!=null){_ref.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+(user.get("username")));}
if((_ref2=signedInNode.one("a.logout"))!=null){_ref2.setAttribute("href",""+Constants.ID_MANAGER+"/fans/logout"+returnTo);}
if((_ref3=signedInNode.one("a.arrow-container"))!=null){_ref3.on("click",toggleProfileLinks);}
if((_ref4=signedInNode.one("div.user-profile"))!=null){_ref4.on("mouseleave",toggleProfileLinks);}
signedInNode.delegate("click",(function(e){var socialLinkNode;socialLinkNode=e.currentTarget;if(!socialLinkNode.hasClass("checked")){return user.addConnection(socialLinkNode.getAttribute("data-provider"));}}),"a.social");signedInNode.delegate("touchstart",(function(e){var socialLinkNode;socialLinkNode=e.currentTarget;if(!socialLinkNode.hasClass("checked")){return user.addConnection(socialLinkNode.getAttribute("data-provider"));}}),"a.social");user.on(Y.NFL.User.SOCIAL_PROVIDER_ADDED_EVENT,function(response){var provider,providerNode;provider=response.provider;providerNode=signedInNode.one("a."+provider);if(providerNode!=null)providerNode.addClass("checked");return providerNode!=null?providerNode.append("<i class='checked'></i>"):void 0;});providers=user.get("providers");_results=[];for(provider in providers){connected=providers[provider];if(connected){providerNode=signedInNode.one("a."+provider);if(providerNode!=null)providerNode.addClass("checked");_results.push(providerNode!=null?providerNode.append("<i class='checked'></i>"):void 0);}else{_results.push(void 0);}}
return _results;}else{signedOutNode=headerNode.one("div.signed-out");templateNode=Y.one("#template-signed-out");template=templateNode&&templateNode.getHTML();if(template){signedOutNode.setContent(template);}
if(signedOutNode){signedOutNode.one("a.sign-in").setAttribute("href",""+Constants.ID_MANAGER+"/fans/login"+returnTo);signedOutNode.one("a.register").setAttribute("href",""+Constants.ID_MANAGER+"/fans/register"+returnTo);if((_ref5=headerNode.one("div.signed-out"))!=null){_ref5.setStyle("display","block");if(Modernizr.postmessage){new Y.NFL.ModalLogin({contentBox:Y.Node.create("<div class='modal-login'></div>"),linkNodes:signedOutNode.all("a")._nodes,render:true});}}}
return headerNode.one("div.content.fans").all("a.link-provider").setStyle("display","none");}};}),"1.0.0",{requires:["nfl-user","node","substitute","event-mouseenter","anim","header-anim-plugins","plugin","header-2012-base","event-touch","modal-login"]});}).call(this);;(function(){YUI.add("hp-fantasy",(function(Y){"use strict";return Y.namespace("NFL.Header2012").PersonalizeFantasySection=function(){var containerNode,fnmy,hideInactiveLeagues,template,templateNode,user;containerNode=Y.one("#header-2012-fnmy");templateNode=containerNode!=null?containerNode.one("script"):void 0;template=templateNode!=null?templateNode.getContent():void 0;if(templateNode&&containerNode)containerNode.setContent(template);fnmy=new Y.NFL.Fantasy.MyTeamsFantasyNavBox({'container':"#header-2012-fnmy"});user=Y.NFL.User.getCurrent();var hideInactivesCalled=false;try{hideInactiveLeagues=function(){if(hideInactivesCalled){return;}
hideInactivesCalled=true;nfl.use("nfl-user",function(Y){if(user){if(Y.Cookie.get('ff')==null){user.getFantasyData(true,function(e){var fantasyData=e.data,leagues=fantasyData.leagues;if(leagues.length<3){return containerNode.all("div.team-node").each(function(elm,i){if(i+1>leagues.length){return elm.setStyle("display","none");}});}});}else{var fantasyData=Y.NFL.User.parseFantasyCookie(),leagues=fantasyData.leagues;if(leagues.length<3){containerNode.all("div.team-node").each(function(elm,i){if(i+1>leagues.length){elm.setStyle("display","none");}});}}}});};hideInactiveLeagues();Y.later(5000,this,hideInactiveLeagues);}catch(error){console.error("Error hiding empty fantasy leagues",error);}};}),"1.0.0",{requires:["nfl-fantasy-myteams","cookie","querystring-parse","nfl-user"]});}).call(this);;(function(){YUI.add("hp-team",(function(Y){"use strict";var Constants;Constants=nfl.constants;Y.namespace("NFL.Header2012").PersonalizeTeam=function(){var favTeam,headerNode,setTeamInfo,teamChooseNode,teamNewsNode,teamScheduleNode,teams,user,videoChannelNode,_ref,_ref2,_ref3;headerNode=window.Y.namespace("NFL.Header2012").headerNode;user=Y.NFL.User.getCurrent();teams=Y.NFL.Header2012.teams;if(user)favTeam=teams!=null?teams[user.get("team")]:void 0;setTeamInfo=function(teamAbbr){var infoLinkNode,infoLinkNodes,linkNode,team,teamInfoNode,topLabelNode,_i,_len;teamInfoNode=headerNode.all("div.team-info");team=teams!=null?teams[teamAbbr]:void 0;teamInfoNode.each(function(item){topLabelNode=item!=null?item.one("div.top-label"):void 0;if(topLabelNode!=null){topLabelNode.setContent(""+team.city+" "+team.nickname+" info");}
if(topLabelNode!=null)topLabelNode.set("className","top-label");if(topLabelNode!=null)topLabelNode.addClass(""+teamAbbr+"font");infoLinkNodes=[{node:"a.team-profile",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/profile?team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})},{node:"a.roster",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/roster?team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})},{node:"a.depth-chart",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/depthchart?team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})},{node:"a.transactions",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/transactions?team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})},{node:"a.injuries",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/injuries?team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})},{node:"a.coaches",href:Y.substitute(""+Constants.SITE_URL+"/teams/{citynickname}/coaches?coaType=head&team={abbr}",{citynickname:team.citynickname,abbr:team.abbr})}];for(_i=0,_len=infoLinkNodes.length;_i<_len;_i++){infoLinkNode=infoLinkNodes[_i];linkNode=item.one(infoLinkNode.node);if(linkNode){linkNode.setAttribute("href",infoLinkNode.href);linkNode.addClass("active");}}})
return teamInfoNode.each(function(item){item.all("a.team-info").setStyle("visibility","visible");})};teamChooseNode=headerNode.all("div.choose-team");if(teamChooseNode.size()>0){teamChooseNode.each(function(item){item.delegate("click",function(e){var teamNode;teamNode=e.currentTarget;if(teamNode&&teamNode.getAttribute('data-abbr')){return setTeamInfo(teamNode.getAttribute('data-abbr'));}},"a");});}
if(user&&favTeam){setTeamInfo(favTeam.abbr);teamScheduleNode=(_ref=headerNode.one(".b-nav-group.header-item-schedules"))!=null?_ref.one("a.team-schedule"):void 0;if(teamScheduleNode){teamScheduleNode.setAttribute("href",Y.substitute(""+Constants.SITE_URL+"/schedules/{seasonYear}/{seasonType}/{nickname}",{nickname:favTeam.nickname,seasonYear:favTeam.seasonYear,seasonType:favTeam.seasonType}));teamScheduleNode.setContent(""+favTeam.nickname+" Schedule");teamScheduleNode.set("className","team-schedule "+favTeam.abbr+"font");}
videoChannelNode=(_ref2=headerNode.one(".b-nav-group.video"))!=null?_ref2.one("a.user-team"):void 0;if(videoChannelNode){videoChannelNode.setAttribute("href",""+Constants.SITE_URL+"/videos/"+favTeam.cityHyphenated+"-"+favTeam.nicknameHyphenated);videoChannelNode.setContent(""+favTeam.nickname+" Channel");videoChannelNode.set("className","user-team "+favTeam.abbr+"font");}
teamNewsNode=(_ref3=headerNode.one(".b-nav-group.news"))!=null?_ref3.one("a.user-team"):void 0;if(teamNewsNode){teamNewsNode.setAttribute("href","//"+Constants.SEARCH_DOMAIN+"/search/?query="+favTeam.cityEncoded+"%20"+favTeam.nicknameEncoded+"&sortBy=date");teamNewsNode.setContent(""+favTeam.nickname+" News");return teamNewsNode.set("className","user-team "+favTeam.abbr+"font");}}};}),"1.0.0",{requires:["nfl-user","node","substitute","header-2012-base","header-teams","hp-teams-links","header-season"]});}).call(this);;(function(){YUI.add("hp-fans",(function(Y){"use strict";var Constants;Constants=nfl.constants;return Y.namespace("NFL.Header2012").PersonalizeFan=function(){var connected,fansNode,linkNode,loginUrl,provider,providers,user,username,_ref,_ref2,_ref3,_ref4,_ref5,_ref6,_ref7,_ref8;user=Y.NFL.User.getCurrent();fansNode=Y.one("#header-2012 div.content.fans");if(user){if(fansNode!=null){fansNode.delegate("click",(function(e){var socialLinkNode;socialLinkNode=e.currentTarget;if(!socialLinkNode.hasClass("linked")){return user.addConnection(socialLinkNode.getAttribute("data-provider"));}}),"a.link-provider");}
providers=user.get("providers");for(provider in providers){connected=providers[provider];if(connected&&(provider==="facebook"||provider==="twitter")){linkNode=fansNode!=null?fansNode.one("a.link-"+provider):void 0;linkNode.setContent("<i class='check'></i> Account Linked");}}
username=user.get("username");if((_ref=fansNode.one("a.my-profile"))!=null){_ref.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+username);}
if((_ref2=fansNode.one("a.shout-outs"))!=null){_ref2.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+username+"/shout-outs");}
if((_ref3=fansNode.one("a.activity"))!=null){_ref3.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+username+"/activity");}
return(_ref4=fansNode.one("a.friends"))!=null?_ref4.setAttribute("href",""+Constants.SITE_URL+"/fans/profile/"+username+"/friends"):void 0;}else{loginUrl=""+nfl.constants.ID_MANAGER+"/fans/login";if((_ref5=fansNode.one("a.my-profile"))!=null){_ref5.setAttribute("href",loginUrl);}
if((_ref6=fansNode.one("a.shout-outs"))!=null){_ref6.setAttribute("href",loginUrl);}
if((_ref7=fansNode.one("a.activity"))!=null){_ref7.setAttribute("href",loginUrl);}
return(_ref8=fansNode.one("a.friends"))!=null?_ref8.setAttribute("href",loginUrl):void 0;}};}),"1.0.0",{requires:["nfl-user","node"]});}).call(this);