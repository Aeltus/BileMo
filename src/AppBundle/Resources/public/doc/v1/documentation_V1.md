# Address #

## /address/{address} ##

### `DELETE` /address/{address} ###

_Delete an address identified by {id}. (This address is set to not available, not completely deleted)_

#### Requirements ####

**address**

  - Requirement: \d+
  - Type: integer
  - Description: The address unique identifier.


## /address/{customer} ##

### `POST` /address/{customer} ###

_Add an address to a Customer identified by {id}. Accept an address entity in JSON format, in body._

#### Requirements ####

**customer**

  - Requirement: \d+
  - Type: integer
  - Description: The Customer unique identifier.

#### Parameters ####

address1:

  * type: string
  * required: true

address2:

  * type: string
  * required: false

address3:

  * type: string
  * required: false

city:

  * type: object (City)
  * required: false

city[id]:

  * type: integer
  * required: false

city[name]:

  * type: string
  * required: true

city[zip_code]:

  * type: string
  * required: false

city[country]:

  * type: object (Country)
  * required: false

city[country][id]:

  * type: integer
  * required: false

city[country][name]:

  * type: string
  * required: false

city[zipCode]:

  * type: string
  * required: true

isAvailable:

  * type: bool
  * required: true

isDefault:

  * type: bool
  * required: true

id:

  * type: integer
  * required: false

is_available:

  * type: boolean
  * required: false

is_default:

  * type: boolean
  * required: false

customer_address:

  * type: object (Customer)
  * required: false

customer_address[id]:

  * type: integer
  * required: false

customer_address[password]:

  * type: string
  * required: true

customer_address[salt]:

  * type: string
  * required: true

customer_address[is_checked]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

customer_address[delivery_addresses][][id]:

  * type: integer
  * required: false

customer_address[delivery_addresses][][address1]:

  * type: string
  * required: true

customer_address[delivery_addresses][][address2]:

  * type: string
  * required: false

customer_address[delivery_addresses][][address3]:

  * type: string
  * required: false

customer_address[delivery_addresses][][city]:

  * type: object (City)
  * required: false

customer_address[delivery_addresses][][is_available]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][][is_default]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][][customer_address]:

  * type: object (Customer)
  * required: false

customer_address[delivery_addresses][][isAvailable]:

  * type: bool
  * required: true

customer_address[delivery_addresses][][isDefault]:

  * type: bool
  * required: true

customer_address[consumer]:

  * type: object (Consumer)
  * required: false

customer_address[consumer][id]:

  * type: integer
  * required: false

customer_address[consumer][society_name]:

  * type: string
  * required: false

customer_address[consumer][payments_delay]:

  * type: string
  * required: false

customer_address[consumer][brands][]:

  * type: array of objects (Brand)
  * required: false

customer_address[consumer][brands][][name]:

  * type: string
  * required: false

customer_address[consumer][name]:

  * type: string
  * required: false

customer_address[consumer][surname]:

  * type: string
  * required: false

customer_address[consumer][billing_address]:

  * type: object (Address)
  * required: false

customer_address[consumer][phone]:

  * type: string
  * required: false

customer_address[consumer][cell_phone]:

  * type: string
  * required: false

customer_address[consumer][mail]:

  * type: string
  * required: false

customer_address[consumer][is_available]:

  * type: boolean
  * required: false
  * default value: 1

customer_address[name]:

  * type: string
  * required: true

customer_address[surname]:

  * type: string
  * required: true

customer_address[billing_address]:

  * type: object (Address)
  * required: false

customer_address[phone]:

  * type: string
  * required: false

customer_address[cell_phone]:

  * type: string
  * required: false

customer_address[mail]:

  * type: string
  * required: false

customer_address[is_available]:

  * type: boolean
  * required: false
  * default value: 1

customer_address[isChecked]:

  * type: bool
  * required: true

customer_address[deliveryAddresses]:

  * type: 
  * required: false

customer_address[billingAddress]:

  * type: 
  * required: false

customer_address[cellPhone]:

  * type: string
  * required: false

customer_address[isAvailable]:

  * type: bool
  * required: true
  * default value: 1


## /address/{id} ##

### `PUT` /address/{id} ###

_Update an address identified by {id}. Accept an address entity in JSON format, in body._

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The address unique identifier.

#### Parameters ####

address1:

  * type: string
  * required: true

address2:

  * type: string
  * required: false

address3:

  * type: string
  * required: false

city:

  * type: object (City)
  * required: false

city[id]:

  * type: integer
  * required: false

city[name]:

  * type: string
  * required: true

city[zip_code]:

  * type: string
  * required: false

city[country]:

  * type: object (Country)
  * required: false

city[country][id]:

  * type: integer
  * required: false

city[country][name]:

  * type: string
  * required: false

city[zipCode]:

  * type: string
  * required: true

isAvailable:

  * type: bool
  * required: true

isDefault:

  * type: bool
  * required: true

id:

  * type: integer
  * required: false

is_available:

  * type: boolean
  * required: false

is_default:

  * type: boolean
  * required: false

customer_address:

  * type: object (Customer)
  * required: false

customer_address[id]:

  * type: integer
  * required: false

customer_address[password]:

  * type: string
  * required: true

customer_address[salt]:

  * type: string
  * required: true

customer_address[is_checked]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

customer_address[delivery_addresses][][id]:

  * type: integer
  * required: false

customer_address[delivery_addresses][][address1]:

  * type: string
  * required: true

customer_address[delivery_addresses][][address2]:

  * type: string
  * required: false

customer_address[delivery_addresses][][address3]:

  * type: string
  * required: false

customer_address[delivery_addresses][][city]:

  * type: object (City)
  * required: false

customer_address[delivery_addresses][][is_available]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][][is_default]:

  * type: boolean
  * required: false

customer_address[delivery_addresses][][customer_address]:

  * type: object (Customer)
  * required: false

customer_address[delivery_addresses][][isAvailable]:

  * type: bool
  * required: true

customer_address[delivery_addresses][][isDefault]:

  * type: bool
  * required: true

customer_address[consumer]:

  * type: object (Consumer)
  * required: false

customer_address[consumer][id]:

  * type: integer
  * required: false

customer_address[consumer][society_name]:

  * type: string
  * required: false

customer_address[consumer][payments_delay]:

  * type: string
  * required: false

customer_address[consumer][brands][]:

  * type: array of objects (Brand)
  * required: false

customer_address[consumer][brands][][name]:

  * type: string
  * required: false

customer_address[consumer][name]:

  * type: string
  * required: false

customer_address[consumer][surname]:

  * type: string
  * required: false

customer_address[consumer][billing_address]:

  * type: object (Address)
  * required: false

customer_address[consumer][phone]:

  * type: string
  * required: false

customer_address[consumer][cell_phone]:

  * type: string
  * required: false

customer_address[consumer][mail]:

  * type: string
  * required: false

customer_address[consumer][is_available]:

  * type: boolean
  * required: false
  * default value: 1

customer_address[name]:

  * type: string
  * required: true

customer_address[surname]:

  * type: string
  * required: true

customer_address[billing_address]:

  * type: object (Address)
  * required: false

customer_address[phone]:

  * type: string
  * required: false

customer_address[cell_phone]:

  * type: string
  * required: false

customer_address[mail]:

  * type: string
  * required: false

customer_address[is_available]:

  * type: boolean
  * required: false
  * default value: 1

customer_address[isChecked]:

  * type: bool
  * required: true

customer_address[deliveryAddresses]:

  * type: 
  * required: false

customer_address[billingAddress]:

  * type: 
  * required: false

customer_address[cellPhone]:

  * type: string
  * required: false

customer_address[isAvailable]:

  * type: bool
  * required: true
  * default value: 1



# Articles #

## /articles ##

### `GET` /articles ###

_Get the list of products, and linked products._

#### Filters ####

brand:

  * Requirement: \w+
  * Description: The brand to search for

order:

  * Requirement: asc|desc
  * Description: Sort order (asc or desc)
  * Default: asc

limit:

  * Requirement: \d+
  * Description: Max number of products per page.
  * Default: 10

page:

  * Requirement: \d+
  * Description: The pagination offset
  * Default: 1


## /articles/details/{id} ##

### `GET` /articles/details/{id} ###

_Get just one product in details identified by {id}._

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The article unique identifier.


## /articles/{id} ##

### `GET` /articles/{id} ###

_Get just one product identified by {id}._

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The article unique identifier.



# Customers #

## /customers ##

### `GET` /customers ###

_Get all customers_

#### Filters ####

mail:

  * Requirement: ^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$
  * Description: The mail to search for

order:

  * Requirement: asc|desc
  * Description: Sort order (asc or desc)
  * Default: asc

limit:

  * Requirement: \d+
  * Description: Max number of products per page.
  * Default: 10

page:

  * Requirement: \d+
  * Description: The pagination offset
  * Default: 1

isAvailable:

  * Requirement: TRUE|FALSE|true|false|0|1
  * Description: Availability of the customer (TRUE or FALSE)
  * Default: TRUE


### `POST` /customers ###

_Add a customer. Accept a customer entity in JSON format, in body._

#### Parameters ####

password:

  * type: string
  * required: true

salt:

  * type: string
  * required: true

isChecked:

  * type: bool
  * required: true

deliveryAddresses:

  * type: 
  * required: false

consumer:

  * type: object (Consumer)
  * required: false

consumer[id]:

  * type: integer
  * required: false

consumer[society_name]:

  * type: string
  * required: false

consumer[payments_delay]:

  * type: string
  * required: false

consumer[brands][]:

  * type: array of objects (Brand)
  * required: false

consumer[brands][][name]:

  * type: string
  * required: true

consumer[name]:

  * type: string
  * required: true

consumer[surname]:

  * type: string
  * required: true

consumer[billing_address]:

  * type: object (Address)
  * required: false

consumer[billing_address][id]:

  * type: integer
  * required: false

consumer[billing_address][address1]:

  * type: string
  * required: false

consumer[billing_address][address2]:

  * type: string
  * required: false

consumer[billing_address][address3]:

  * type: string
  * required: false

consumer[billing_address][city]:

  * type: object (City)
  * required: false

consumer[billing_address][city][id]:

  * type: integer
  * required: false

consumer[billing_address][city][name]:

  * type: string
  * required: false

consumer[billing_address][city][zip_code]:

  * type: string
  * required: false

consumer[billing_address][city][country]:

  * type: object (Country)
  * required: false

consumer[billing_address][city][country][id]:

  * type: integer
  * required: false

consumer[billing_address][city][country][name]:

  * type: string
  * required: false

consumer[billing_address][is_available]:

  * type: boolean
  * required: false

consumer[billing_address][is_default]:

  * type: boolean
  * required: false

consumer[billing_address][customer_address]:

  * type: object (Customer)
  * required: false

consumer[billing_address][customer_address][id]:

  * type: integer
  * required: false

consumer[billing_address][customer_address][password]:

  * type: string
  * required: false

consumer[billing_address][customer_address][salt]:

  * type: string
  * required: false

consumer[billing_address][customer_address][is_checked]:

  * type: boolean
  * required: false

consumer[billing_address][customer_address][delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

consumer[billing_address][customer_address][consumer]:

  * type: object (Consumer)
  * required: false

consumer[billing_address][customer_address][name]:

  * type: string
  * required: false

consumer[billing_address][customer_address][surname]:

  * type: string
  * required: false

consumer[billing_address][customer_address][billing_address]:

  * type: object (Address)
  * required: false

consumer[billing_address][customer_address][phone]:

  * type: string
  * required: false

consumer[billing_address][customer_address][cell_phone]:

  * type: string
  * required: false

consumer[billing_address][customer_address][mail]:

  * type: string
  * required: false

consumer[billing_address][customer_address][is_available]:

  * type: boolean
  * required: false
  * default value: 1

consumer[phone]:

  * type: string
  * required: false

consumer[cell_phone]:

  * type: string
  * required: false

consumer[mail]:

  * type: string
  * required: false

consumer[is_available]:

  * type: boolean
  * required: false
  * default value: 1

consumer[billingAddress]:

  * type: 
  * required: false

consumer[cellPhone]:

  * type: string
  * required: false

consumer[isAvailable]:

  * type: bool
  * required: true
  * default value: 1

name:

  * type: string
  * required: true

surname:

  * type: string
  * required: true

billingAddress:

  * type: 
  * required: false

phone:

  * type: string
  * required: false

cellPhone:

  * type: string
  * required: false

mail:

  * type: string
  * required: false

isAvailable:

  * type: bool
  * required: true
  * default value: 1

id:

  * type: integer
  * required: false

is_checked:

  * type: boolean
  * required: false

delivery_addresses[]:

  * type: array of objects (Address)
  * required: false

delivery_addresses[][id]:

  * type: integer
  * required: false

delivery_addresses[][address1]:

  * type: string
  * required: true

delivery_addresses[][address2]:

  * type: string
  * required: false

delivery_addresses[][address3]:

  * type: string
  * required: false

delivery_addresses[][city]:

  * type: object (City)
  * required: false

delivery_addresses[][city][id]:

  * type: integer
  * required: false

delivery_addresses[][city][name]:

  * type: string
  * required: false

delivery_addresses[][city][zip_code]:

  * type: string
  * required: false

delivery_addresses[][city][country]:

  * type: object (Country)
  * required: false

delivery_addresses[][city][country][id]:

  * type: integer
  * required: false

delivery_addresses[][city][country][name]:

  * type: string
  * required: false

delivery_addresses[][is_available]:

  * type: boolean
  * required: false

delivery_addresses[][is_default]:

  * type: boolean
  * required: false

delivery_addresses[][customer_address]:

  * type: object (Customer)
  * required: false

delivery_addresses[][customer_address][id]:

  * type: integer
  * required: false

delivery_addresses[][customer_address][password]:

  * type: string
  * required: true

delivery_addresses[][customer_address][salt]:

  * type: string
  * required: true

delivery_addresses[][customer_address][is_checked]:

  * type: boolean
  * required: false

delivery_addresses[][customer_address][delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

delivery_addresses[][customer_address][consumer]:

  * type: object (Consumer)
  * required: false

delivery_addresses[][customer_address][consumer][id]:

  * type: integer
  * required: false

delivery_addresses[][customer_address][consumer][society_name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][payments_delay]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][brands][]:

  * type: array of objects (Brand)
  * required: false

delivery_addresses[][customer_address][consumer][brands][][name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][surname]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][billing_address]:

  * type: object (Address)
  * required: false

delivery_addresses[][customer_address][consumer][phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][cell_phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][mail]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][is_available]:

  * type: boolean
  * required: false
  * default value: 1

delivery_addresses[][customer_address][name]:

  * type: string
  * required: true

delivery_addresses[][customer_address][surname]:

  * type: string
  * required: true

delivery_addresses[][customer_address][billing_address]:

  * type: object (Address)
  * required: false

delivery_addresses[][customer_address][phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][cell_phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][mail]:

  * type: string
  * required: false

delivery_addresses[][customer_address][is_available]:

  * type: boolean
  * required: false
  * default value: 1

delivery_addresses[][customer_address][isChecked]:

  * type: bool
  * required: true

delivery_addresses[][customer_address][deliveryAddresses]:

  * type: 
  * required: false

delivery_addresses[][customer_address][billingAddress]:

  * type: 
  * required: false

delivery_addresses[][customer_address][cellPhone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][isAvailable]:

  * type: bool
  * required: true
  * default value: 1

delivery_addresses[][isAvailable]:

  * type: bool
  * required: true

delivery_addresses[][isDefault]:

  * type: bool
  * required: true

billing_address:

  * type: object (Address)
  * required: false

cell_phone:

  * type: string
  * required: false

is_available:

  * type: boolean
  * required: false
  * default value: 1


## /customers/{id} ##

### `DELETE` /customers/{id} ###

_Delete a customer identified by {id}. (The customer is not completely deleted, his property isAvailable is set to False)_

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The customer unique identifier.


### `GET` /customers/{id} ###

_Get a customer identified by {id}_

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The customer unique identifier.


### `PUT` /customers/{id} ###

_Update a customer identified by {id}. Accept a customer entity in JSON format, in body._

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: The customer unique identifier.

#### Parameters ####

password:

  * type: string
  * required: true

salt:

  * type: string
  * required: true

isChecked:

  * type: bool
  * required: true

deliveryAddresses:

  * type: 
  * required: false

consumer:

  * type: object (Consumer)
  * required: false

consumer[id]:

  * type: integer
  * required: false

consumer[society_name]:

  * type: string
  * required: false

consumer[payments_delay]:

  * type: string
  * required: false

consumer[brands][]:

  * type: array of objects (Brand)
  * required: false

consumer[brands][][name]:

  * type: string
  * required: true

consumer[name]:

  * type: string
  * required: true

consumer[surname]:

  * type: string
  * required: true

consumer[billing_address]:

  * type: object (Address)
  * required: false

consumer[billing_address][id]:

  * type: integer
  * required: false

consumer[billing_address][address1]:

  * type: string
  * required: false

consumer[billing_address][address2]:

  * type: string
  * required: false

consumer[billing_address][address3]:

  * type: string
  * required: false

consumer[billing_address][city]:

  * type: object (City)
  * required: false

consumer[billing_address][city][id]:

  * type: integer
  * required: false

consumer[billing_address][city][name]:

  * type: string
  * required: false

consumer[billing_address][city][zip_code]:

  * type: string
  * required: false

consumer[billing_address][city][country]:

  * type: object (Country)
  * required: false

consumer[billing_address][city][country][id]:

  * type: integer
  * required: false

consumer[billing_address][city][country][name]:

  * type: string
  * required: false

consumer[billing_address][is_available]:

  * type: boolean
  * required: false

consumer[billing_address][is_default]:

  * type: boolean
  * required: false

consumer[billing_address][customer_address]:

  * type: object (Customer)
  * required: false

consumer[billing_address][customer_address][id]:

  * type: integer
  * required: false

consumer[billing_address][customer_address][password]:

  * type: string
  * required: false

consumer[billing_address][customer_address][salt]:

  * type: string
  * required: false

consumer[billing_address][customer_address][is_checked]:

  * type: boolean
  * required: false

consumer[billing_address][customer_address][delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

consumer[billing_address][customer_address][consumer]:

  * type: object (Consumer)
  * required: false

consumer[billing_address][customer_address][name]:

  * type: string
  * required: false

consumer[billing_address][customer_address][surname]:

  * type: string
  * required: false

consumer[billing_address][customer_address][billing_address]:

  * type: object (Address)
  * required: false

consumer[billing_address][customer_address][phone]:

  * type: string
  * required: false

consumer[billing_address][customer_address][cell_phone]:

  * type: string
  * required: false

consumer[billing_address][customer_address][mail]:

  * type: string
  * required: false

consumer[billing_address][customer_address][is_available]:

  * type: boolean
  * required: false
  * default value: 1

consumer[phone]:

  * type: string
  * required: false

consumer[cell_phone]:

  * type: string
  * required: false

consumer[mail]:

  * type: string
  * required: false

consumer[is_available]:

  * type: boolean
  * required: false
  * default value: 1

consumer[billingAddress]:

  * type: 
  * required: false

consumer[cellPhone]:

  * type: string
  * required: false

consumer[isAvailable]:

  * type: bool
  * required: true
  * default value: 1

name:

  * type: string
  * required: true

surname:

  * type: string
  * required: true

billingAddress:

  * type: 
  * required: false

phone:

  * type: string
  * required: false

cellPhone:

  * type: string
  * required: false

mail:

  * type: string
  * required: false

isAvailable:

  * type: bool
  * required: true
  * default value: 1

id:

  * type: integer
  * required: false

is_checked:

  * type: boolean
  * required: false

delivery_addresses[]:

  * type: array of objects (Address)
  * required: false

delivery_addresses[][id]:

  * type: integer
  * required: false

delivery_addresses[][address1]:

  * type: string
  * required: true

delivery_addresses[][address2]:

  * type: string
  * required: false

delivery_addresses[][address3]:

  * type: string
  * required: false

delivery_addresses[][city]:

  * type: object (City)
  * required: false

delivery_addresses[][city][id]:

  * type: integer
  * required: false

delivery_addresses[][city][name]:

  * type: string
  * required: false

delivery_addresses[][city][zip_code]:

  * type: string
  * required: false

delivery_addresses[][city][country]:

  * type: object (Country)
  * required: false

delivery_addresses[][city][country][id]:

  * type: integer
  * required: false

delivery_addresses[][city][country][name]:

  * type: string
  * required: false

delivery_addresses[][is_available]:

  * type: boolean
  * required: false

delivery_addresses[][is_default]:

  * type: boolean
  * required: false

delivery_addresses[][customer_address]:

  * type: object (Customer)
  * required: false

delivery_addresses[][customer_address][id]:

  * type: integer
  * required: false

delivery_addresses[][customer_address][password]:

  * type: string
  * required: true

delivery_addresses[][customer_address][salt]:

  * type: string
  * required: true

delivery_addresses[][customer_address][is_checked]:

  * type: boolean
  * required: false

delivery_addresses[][customer_address][delivery_addresses][]:

  * type: array of objects (Address)
  * required: false

delivery_addresses[][customer_address][consumer]:

  * type: object (Consumer)
  * required: false

delivery_addresses[][customer_address][consumer][id]:

  * type: integer
  * required: false

delivery_addresses[][customer_address][consumer][society_name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][payments_delay]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][brands][]:

  * type: array of objects (Brand)
  * required: false

delivery_addresses[][customer_address][consumer][brands][][name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][name]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][surname]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][billing_address]:

  * type: object (Address)
  * required: false

delivery_addresses[][customer_address][consumer][phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][cell_phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][mail]:

  * type: string
  * required: false

delivery_addresses[][customer_address][consumer][is_available]:

  * type: boolean
  * required: false
  * default value: 1

delivery_addresses[][customer_address][name]:

  * type: string
  * required: true

delivery_addresses[][customer_address][surname]:

  * type: string
  * required: true

delivery_addresses[][customer_address][billing_address]:

  * type: object (Address)
  * required: false

delivery_addresses[][customer_address][phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][cell_phone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][mail]:

  * type: string
  * required: false

delivery_addresses[][customer_address][is_available]:

  * type: boolean
  * required: false
  * default value: 1

delivery_addresses[][customer_address][isChecked]:

  * type: bool
  * required: true

delivery_addresses[][customer_address][deliveryAddresses]:

  * type: 
  * required: false

delivery_addresses[][customer_address][billingAddress]:

  * type: 
  * required: false

delivery_addresses[][customer_address][cellPhone]:

  * type: string
  * required: false

delivery_addresses[][customer_address][isAvailable]:

  * type: bool
  * required: true
  * default value: 1

delivery_addresses[][isAvailable]:

  * type: bool
  * required: true

delivery_addresses[][isDefault]:

  * type: bool
  * required: true

billing_address:

  * type: object (Address)
  * required: false

cell_phone:

  * type: string
  * required: false

is_available:

  * type: boolean
  * required: false
  * default value: 1
