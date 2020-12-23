### About This Project

Given that this was designed to be a three hour task mimicking a project with multiple sub-tasks, I approached it with the philosophy of creating something imperfect, but functional. There are a few places where I intentionally wrote code that would partially solve a problem in order to indicate my awareness of it while still focusing on the core feature.

## General Approach

- DB: one table for descriptive information for a channel, while the other table tracked the subscription numbers on each date
- Queues and Jobs: At scale, we might be scanning millions of unique channels. Queues offer flexibility in when and how we retrieve the new information. Having one job per channel means that any failures or errors would only effect that job. We could also change how frequently a job goes out in case our requests-per-minute is ever limited. At a certain scale, it would probably make sense to put the two tasks in their own queues.
- Routing: I created both API and web routes for ease of testing that my code worked. The web routes would be likely be removed or altered, depending on the needs of the project

## What I Would Do With More Time

- Unit testing. Like many, "developer mode" and "what could go wrong" tend to involve separate brain pathways. While I would architect the project first, I would prefer to then think about how my code could break and build the tests.
- Elegant handling of failed jobs. Whether that's retrieving channel descriptions or getting subscriber numbers, multiple things could go wrong. And we'd probably handle some of them differently than others. 
- API restrictions. Some basic things like request limitations on those getting channel subscriber difference information, while we might keep the Add Channel endpoint completely internal, or limit it to those we give access tokens to.
- General error handling. There's a lot more we'd want to surface to the user or to ourselves when things break
- User experience. We have none at the moment, but it seems like something the product managers would like. Like, users could search for the channels of their favorite Youtubers and get this information?
- Related to the above, I'd look into getting more channel information. I went with 'title' for the sake of indication, but we'd probably get more.
- Options of data retrieval. Some people would want only a few days of info, some might want a whole year. Some might want the raw numbers over time, others might want the diff.
- Handling "dead" URLs. Either the channel was deleted, or a URL passed our screening but doesn't lead to a channel. For the latter, the AddChannel job would check for something relevant and fail. For the former, we'd probably want a weekly or monthly job that would look for urls with jobs that were consistently failing, and stop sending them out. We might send ourselves a message to find out what was up with that channel, and indicate to our users what happened to the channel while still holding on to our data.

### Your Out-of-the-box Laravel README

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
