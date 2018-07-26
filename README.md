# Openclassrooms_PHP_OOP_news_system

## What is it ? 

This program had been written for the Openclassrooms course on the object oriented programmation with PHP :
https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668165-tp-un-systeme-de-news

It requres a SQL file that you can create with this instruction : 

```sql
CREATE TABLE `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `dateAdd` datetime NOT NULL,
  `dateEdit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
```

It's a simple interface for a news system. I used the pattern Factory and here is the UML of his architecture : 
![uml](/uml.png)
