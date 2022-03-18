#Getting started 

##Installation 
Clone the repository 

```sh
git clone git@github.com:CODAC-BDX-Vincent/yowl-bdx.git
```

Switch to the repo folder
```sh
cd yowl-bdx
```

Install all the dependencies using composer

```sh
composer install
```

Copy the example env file and make the required configuration changes in the .env file
```sh
cp .env.example .env
```

Generate a new application key

```sh
php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating)
```sh
php artisan migrate
```



Start the local development server

```sh
php artisan serve
```
You can now access the server at http://localhost:8000
#Testing API
Run th

# Get one specific thing via id (users/categories/articles/comments)

## Request

GET /api/things/id

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/things/2

## Response

Status: 200 OK Content-Type: application/json \

## Example

### Get one article

GET /api/articles/2

{\
"id": 2,\
"url": "https://www.lefigaro.fr/politique/comment..",\
"description": "la France sur la voie de l’atome",\
"user_id": 1,\
"created_at": "2021-11-11T10:00:00.000000Z",\
"updated_at": null\
}\

### Get one comment

GET /api/comments/2

{\
&nbsp;&nbsp;&nbsp;"id": 2,\
&nbsp;&nbsp;&nbsp;"content": "Comment content",\
&nbsp;&nbsp;&nbsp;"article_id": 2,\
&nbsp;&nbsp;&nbsp;"user_id": 1,\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T09:06:00.000000Z",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T09:06:00.000000Z"\
}

# Get all things (users/categories/articles/comments)

## Request

GET /api/things

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/things

## Response

Status: 200 OK\
Content-Type: application/json \

## Example

### Get all users

GET /api/users
[\
{\
&nbsp;&nbsp;&nbsp;"id": 1,\
&nbsp;&nbsp;&nbsp;"username": "toto",\
&nbsp;&nbsp;&nbsp;"email": "toto@email.com",\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-03T14:40:36.000000Z",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-03T14:40:36.000000Z",\
&nbsp;&nbsp;&nbsp;"is_admin": 0\
},\
{\
&nbsp;&nbsp;&nbsp;"id": 2,\
&nbsp;&nbsp;&nbsp;"username": "riri",\
&nbsp;&nbsp;&nbsp;"email": "riri@email.com",\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-03T14:42:07.000000Z",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-03T14:42:07.000000Z",\
&nbsp;&nbsp;&nbsp;"is_admin": 0\
}
]

### Get all articles

GET /api/articles

[\
&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;"id": 3,\
&nbsp;&nbsp;&nbsp;"url": "www.lorem.net",\
&nbsp;&nbsp;&nbsp;"description": "User's text",\
&nbsp;&nbsp;&nbsp;"user_id": 1,\
&nbsp;&nbsp;&nbsp;"category_id": 2,\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T14:43:17.000000Z",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T14:43:17.000000Z",\
&nbsp;&nbsp;&nbsp;"user": {\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": 1,\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"username": "toto",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "toto@email.com",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T13:12:00.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T13:12:00.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"is_admin": 0\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},\
&nbsp;&nbsp;&nbsp;"category": {\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": 2,\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Sport",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T13:13:51.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T13:13:51.000000Z"\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},

&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;"id": 3,\
&nbsp;&nbsp;&nbsp;"url": "www.ispum.com",\
&nbsp;&nbsp;&nbsp;"description": "User's text",\
&nbsp;&nbsp;&nbsp;"user_id": 2,\
&nbsp;&nbsp;&nbsp;"category_id": 10,\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T14:43:17.000000Z",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T14:43:17.000000Z",\
&nbsp;&nbsp;&nbsp;"user": {\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": 2,\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"username": "riri",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "riri@email.com",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T13:12:00.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T13:12:00.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"is_admin": 0\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},\
&nbsp;&nbsp;&nbsp;"category": {\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": 10,\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Tech",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04T13:13:51.000000Z",\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04T13:13:51.000000Z"\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},
]

# Create a new article

## Request

POST /api/articles

## Response

Status: 201 OK

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/articles

#### Request body:

[\
&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;url: "https://loremipsum.com",
\
&nbsp;&nbsp;&nbsp;category_id: 1,\
&nbsp;&nbsp;&nbsp;description: "users description",\
&nbsp;&nbsp;&nbsp;user_id: 3,\
&nbsp;&nbsp;&nbsp;}\
]\

# Read / display all articles  with search feature

## Request

POST /api/articles/search

## Response

Status : 200 OK\
Content-Type: application/json\

[\
&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;"id": 3,\
&nbsp;&nbsp;&nbsp;"url": "https://www.lorem.uk",\
&nbsp;&nbsp;&nbsp;"description": "Text from the user",\
&nbsp;&nbsp;&nbsp;"user_id": 1,\
&nbsp;&nbsp;&nbsp;"category_id": 2,\
&nbsp;&nbsp;&nbsp;"created_at": "2021-12-04 14:43:17",\
&nbsp;&nbsp;&nbsp;"updated_at": "2021-12-04 14:43:17",\
&nbsp;&nbsp;&nbsp;"username": "user",\
&nbsp;&nbsp;&nbsp;"categoryname": "Sport"\
}\
,\
&nbsp;&nbsp;&nbsp;{ }\
...\
]


### Request headers:

{ Content-type : 'application/json'}

###Request body;
{searchTerm: 'sport'}

*sending 'searchTerm' in body is optional\
*if no body sent -> response will return all articles by most recent\
*if searchTerm is sent in body, searchTerm will be searched inside article's username/url/description/category name

## Example
curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/articles/search

###body sent 
{searchTerm: 'toto'}

###response 
*response will return all articles including 'toto' inside username/url/description/category name

# Update an article

## Request

PUT /api/articles/id

## Response

Status: 201 OK

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/articles/1

#### Request headers:

{ \
&nbsp;&nbsp;&nbsp;Content-type : 'application/json',\
&nbsp;&nbsp;&nbsp;Authorization : 'Bearer ' + validToken\
}

#### Request body:

{\
&nbsp;&nbsp;&nbsp;url: "url changed or not changed",\
&nbsp;&nbsp;&nbsp;description: "description changed or not changed",\
&nbsp;&nbsp;&nbsp;category_id: 1  (category_id changed or not changed)\
}

# Delete an article

## Request

DELETE /api/articles/id

## Response

Status : 201 OK \
Message: 'Article deleted with success'

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/articles/1

#### Request headers:

{ \
&nbsp;&nbsp;&nbsp;Content-type : 'application/json',\
&nbsp;&nbsp;&nbsp;Authorization : 'Bearer ' + validToken\
}

# Create a comment

## Request

POST /api/comments

## Response

Status: 201 OK

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/comments

#### Request headers:

{ \
&nbsp;&nbsp;&nbsp;Content-type : 'application/json',\
&nbsp;&nbsp;&nbsp;Authorization : 'Bearer ' + validToken\
}

#### Request body:

[\
&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;content:'Comment content',\
&nbsp;&nbsp;&nbsp;article_id: 4,\
&nbsp;&nbsp;&nbsp;user_id: 2,\
&nbsp;&nbsp;&nbsp;}\
]\

# Update a comment

## Request

PUT /api/comments/id

## Response

Status: 201 OK

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/comments/1

#### Request headers:

{ \
&nbsp;&nbsp;&nbsp;Content-type : 'application/json',\
&nbsp;&nbsp;&nbsp;Authorization : 'Bearer ' + validToken\
}

#### Request body:

[\
&nbsp;&nbsp;&nbsp;{\
&nbsp;&nbsp;&nbsp;content:'Comment content changed or not changed',\
&nbsp;&nbsp;&nbsp;article_id: 4,\
&nbsp;&nbsp;&nbsp;user_id: 2,\
&nbsp;&nbsp;&nbsp;}\
]\

# Delete a comment

## Request

DELETE /api/comments/id

## Response

Status : 201 OK \
Message: 'Comment deleted with success'

## Example

curl -i -H 'Accept: application/json' https://yowl-bdx.herokuapp.com/api/comments/1

#### Request headers:

{ \
&nbsp;&nbsp;&nbsp;Content-type : 'application/json',\
&nbsp;&nbsp;&nbsp;Authorization : 'Bearer ' + validToken\
}


#USERS
##index
request GET/api/users\
response\
{\
"id": 5,\
"username": "Daniel not admin",\
"email": "@gmail.com",\
"created_at": "2021-12-03T16:29:46.000000Z",\
"updated_at": "2021-12-03T16:29:46.000000Z",\
"is_admin": 0\
}\
##create
request POST/api/users\
response\
{\
"username": "Xavier",\
"email": "xavier@olivier.com",\
"is_admin": "0",\
"updated_at": "2021-12-03T16:48:21.000000Z",\
"created_at": "2021-12-03T16:48:21.000000Z",\
"id": 6\
}
##update
request PUT/api/users/id\
{\
"id": 5,\
"username": "Daniel not admin",\
"email": "daniel@gmail.com",\
"created_at": "2021-12-03T16:29:46.000000Z",\
"updated_at": "2021-12-03T16:50:54.000000Z",\
"is_admin": 0\
}
##delete
request PUT/api/users/id\
response\
1

#CATEGORIES
##index
request GET/api/categories\
response\
{\
"id": 2,\
"name": "actualité",\
"created_at": "2021-12-03T17:05:26.000000Z",\
"updated_at": "2021-12-03T17:05:57.000000Z"\
},

##store
request POST/api/categories
response\
{\
"name": "informatique",\
"updated_at": "2021-12-03T17:04:20.000000Z",\
"created_at": "2021-12-03T17:04:20.000000Z",\
"id": 1\
}
##update
request PUT/api/categories/id\
response\
{\
"id": 2,\
"name": "actualité",\
"created_at": "2021-12-03T17:05:26.000000Z",\
"updated_at": "2021-12-03T17:05:57.000000Z"\
}
##delete
request DELETE/api/categories/id\
1

#Connexion
##register
request POST/api/register\
response\
{\
"user": {\
"username": "olivier",\
"email": "olivier@gmail.com",\
"is_admin": 0,\
"updated_at": "2021-12-03T16:22:31.000000Z",\
"created_at": "2021-12-03T16:22:31.000000Z",\
"id": 4\
},\
} 

##Login
request POST/api/login\
response\
{\
"user": {\
"id": 5,\
"username": "Daniel not admin",\
"email": "@gmail.com",\
"created_at": "2021-12-03T16:29:46.000000Z",\
"updated_at": "2021-12-03T16:29:46.000000Z",\
"is_admin": 0\
},\
}
##Logout
request POST/api/logout\
response\
{
"message": "Logged out"
}
