# supermarket

This is the Checkout Kata application. Implemented following TDD and SOLID as much as possible.

## How the application is structured

The application has 3 main classes:

1. Item --> This class has 2 attributes: name & price. 
2. Stock --> This class has 1 attribute: items. It accepts an array of items that it will be passed later in getTotalPrice() method of Checkout class
3. Checkout --> This class has 1 attribute: pricingRules. It accepts an array of pricing rules that are implemented before getting the totalPrice of our Stock.

I've created a common **abstract class** called BusinessLogic that is extended in every class that need to validate its own business logic. 
Also, in every validate() method we have custom **exceptions** located at Exception folder.

I've created an **Interface** called PricingCalculatorInterface that is extended in Item class in order to avoid OCP in Checkout class when calculating the total price.

Regarding the tests, I have extended the **setUp()** method and I have also implemented **@dataProvider** called itemProvider in the tests to make them more readable and intuitive. 
The tests check both the types of the variables and their outputs.

![Alt text](src/images/tests.PNG?raw=true "Tests passed")
