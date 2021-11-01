# ApiContacts

A tiny Api rest to add, delete and show all your contacts.

## Database Installation


```bash
CREATE DATABASE IF NOT EXISTS `apicontacts`;
USE `apicontacts`;


CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phones` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


INSERT IGNORE INTO `contacts` (`id`, `name`, `lastname`, `email`, `phones`) VALUES
	(1, 'Brian', 'Polanco', 'brian@test.com', '["829-000-1111"]');
```

## Usage

```
// GET Request:

http://127.0.0.1/apicontacts/contacts

// Return all contacts
```

```
// POST Request:

http://127.0.0.1/apicontacts/contacts

// Body

{
    "name" : "John",                              ->   REQUIRED
    "last_name" : "Doe",                           ->   REQUIRED
    "email" : "john@test.com",                    ->   REQUIRED
    "phones" : ["829-000-1111", "809-555-8899"]   ->   REQUIRED
   
}

```

```
// DELETE Request:

http://127.0.0.1/apicontacts/contacts

// Body

{
    "id" : "contactId",                              
   
}

```

