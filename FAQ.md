# Introduction to PHP Code assignment

We’re looking for passionate and **business oriented engineers** able to transform legacy code into nice and clean codebase.

### This exercise is mainly about

- Showing techniques of [Code Refactoring](https://en.wikipedia.org/wiki/Code_refactoring)
- Demonstrating the knowledge of [DDD](https://en.wikipedia.org/wiki/Domain-driven_design)
  with usage of [Domain Model](https://martinfowler.com/eaaCatalog/domainModel.html) and [Aggregate design](https://martinfowler.com/bliki/DDD_Aggregate.html)
- Using TDD, Design Patterns
- Following Agile principles
- Enjoy the process and Deliver High Quality Code

### Expected way of work

- Take your time and don't rush
- Think about the safety of planned changes
- Demonstrate the way of your reasoning and problem-solving
- Incremental solution is very much appreciated
- Design your code, so it will be open for extension, but closed for modification
- Code must be delivered without bugs and well tested
- No regression
- Next refactoring should be much safer because of improved code quality
- Best practices usage from [phptherightway](https://phptherightway.com/) and [php-fig](https://www.php-fig.org/psr/)
- If you have a question please have a look in [FAQ](FAQ.md). If you could not find the answer, get in touch with our colleague

# Deeper underground

### Why did we decide to plan this work

It works somehow, but we're getting weird bugs
and most importantly we're struggling with adding new features without
introducing new defects.
We also have some unnecessary code in codebase which adds more complexity than needed.
Our business knows that tech debt should be repaid, as well as any other debts ;) So after a data driven investigation,
we came to the conclusion that we need to fix our core codebase.

### Hard constraints

- [PHPUnit](https://packagist.org/packages/phpunit/phpunit) and [Interfaces containing PSR](https://packagist.org/packages/psr/) packages are allowed
- No real databases (use in-memory implementations)
- Keep detailed git history


### inSided platform basics

- inSided is Community Platform Software
- Our platform has many communities
- When a request comes to the application, the identity of
  the user has been already authenticated
- Endpoints are used by third party companies, so you have to keep API contracts.

### inSided platform business constraints (invariants)

- Community is a container of Posts
- Post can be an Article or Conversation type
- Post has content
- Post has title (except Conversation type)
- Post can not have a parent Post
- Users can be an Author of the Post
- User has name
- Users can open a Post created by any Author
- Post can be edited/deleted only by its Author
- Comment can be created by any User to any Post
- Comment has content
- Article can have commenting disabled
- According to GDPR we can't hide data but rather physically delete it

### Known defects

- If we update a Post, we end up with a duplicated one.
- If we disable commenting for an Article, we end up deleting all Comments from it.

### Requested features

- Introduce new User role - Moderator
- Any Post can be edited/deleted by Moderator
- Display Username for each Post

### Submit the code

Once you are happy with your solution you can use the following command to
create a bundle file:

    git bundle create insided-solution.bundle master
You can send the bundle via the email.


######                                            inSided by Gainsight 2022
 

# FAQ
Q: Can you please confirm that I’m free to install packages from Composer that respect the PSR-interfaces?

A: Not exactly, we are referencing to PSR packages that define PSR Interfaces themselves
######                                            inSided by Gainsight 2022
