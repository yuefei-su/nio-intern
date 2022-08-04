function main(str) {
    let obj = {}
    let data = str.split(".").reverse()
    let temp = JSON.parse(JSON.stringify(`{ ${data[0]} : null }`))
    for(let i = 1; i < data.length; i++) {
        obj = JSON.parse(JSON.stringify(`{ ${data[i]} : ${temp} }`))
        temp=JSON.parse(JSON.stringify(obj))
    }
    return obj
}
console.log(main('a.b.c.d'));
// 输出的是字符串'{ a : { b : { c : { d : null } } } }'