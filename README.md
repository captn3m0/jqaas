# jqaas

[`jq`][jq] as a service.

For when you have to do some JSON mangling and you want a web server to do it for you. Supports both request input (using raw request body), and a URL fetch(via a url request param).

# raw request

curl -d '{"hello": [1,2,3]}' -H "JQ-Filter: .hello" https://jqaas.captnemo.in/

# using a remote resource

```bash
curl "https://jqaas.captnemo.in/?url=https://jsonblob.com/api/042e7473-807d-11e7-9e0d-a95b02c92cd2" -H "JQ-Filter: .hello"
[
  1,
  2,
  3
]
```

## License

Licensed under the [MIT License](https://https://nemo.mit-license.org/).