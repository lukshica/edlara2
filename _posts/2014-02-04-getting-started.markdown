---
layout: post
title: "How everything got started"
date: 2014-02-04 05:01:54 +0530
author: gnanakeethan
comments: true
categories: ['introduction']
---


It has been a adventure to start working on this project. This is the first blog post regarding the Project on a Website.So its important to explain the past present and future of the project here.

This project started back in June 2013. Initially the plan was to use Laravel 3 because of its simplicity. Back in time for another 4 months and I had already used Laravel 4 Beta releases. At that time I was new to Laravel development, composer looked almost different than today.

I had used Laravel 3 to get basic understanding of how it does work and the Framework was very good at that time. But the lead developers of Laravel, Taylor Otwell and others have moved on Laravel 4 and released lots of tutorials on Nettuts and Vimeo, that did greatly help me to use the Laravel 4.

The Laravel 4 Stable release was on May 2013, and that went fine. Later that month I had utilised the framework for the first version of Edlara. Thereafter the development phase that has spanned almost 5 months had started. I worked out everything from bottom up approach , and I kept it in mind that I should not re-invent the wheels to get everything done. So I had used some extensions for getting some features done in version one. The most important extension I had used was Sentry by Cartalyst( a Laravel Framework sponsor).

The first version was very complex, and it didn't use most of the Laravel's Blade Templating Capablities. I had coded down another Laravel approach to compile view files than directly templating. The first version doesn't implement anything in a repository pattern, which was new to me at that time. In most cases I didn't follow most development patterns, and mostly mixed all of the logic and database models and views into one.

Now the development of Edlara's second version has started and I have got few more developers than myself. As I wanted to keep the first version as it is , the second version has started on a new repository.

The second version utilizes the Orchestra Platform. The platform is a Free MIT Licensed Platform to Laravel Framework and its a qualified Platform in terms of its extensibility. It does also extend the extensibility of the Laravel.

The development of the version two implements the repository pattern as expected and it must be easier to switch handlers now than version one. currently the Backbone of the Application has been developed. We do have some plans as listed here

* Using a Graph Database backbone to intelligently parse data.
* Using WolframAlpha API to solve unknown question of any kind.
* Developing Standard Suite of Helper Library.