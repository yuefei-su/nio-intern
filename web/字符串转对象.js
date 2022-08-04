// ‘a.b.c’ -> {a: {b: {c: null }}}
// 删除object的某个属性delete Object.property或者delete Object['property']

function main(str) {
    let strArray = str.split(".").reverse();
    let strObj = strArray.reduce((total, current, index) => {
        if (index === 0) {
            total[current] = null;
        } else {
            let newValue = Object.assign({}, total)//深拷贝保存
            total = {}//清空total
            total[current] = newValue;//重新赋值
        }
        return total;
    }, {})
    return strObj;
}

console.log(main('a.b.c.d'));
