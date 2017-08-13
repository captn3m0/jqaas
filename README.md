# jqaas

[`jq`][jq] as a service.

For when you have to do some JSON mangling and you want a web server to do it for you. Supports both request input (using raw request body), and a URL fetch(via a url request param).

# raw request

```sh
curl -d '{"hello": [1,2,3]}'  -H "JQ-Filter: .hello" http://jqaas.captnemo.in/ -i
HTTP/1.1 200 OK
Content-Type: application/json

[1,2,3]
```

# using a remote resource

```sh
curl "https://jqaas.captnemo.in/?url=https://jsonblob.com/api/042e7473-807d-11e7-9e0d-a95b02c92cd2" -H "JQ-Filter: .hello" -i

HTTP/2 200 
content-type: application/json

[1,2,3]
```

## Infra

Currently being served on the Heroku Free Tier over Cloudflare for SSL.

## License

Licensed under the [MIT License](https://https://nemo.mit-license.org/).

[jq]: https://stedolan.github.io/jq/