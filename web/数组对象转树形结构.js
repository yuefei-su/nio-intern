const list = [
    { id: 04, pid: 03 },
    { id: 01, pid: null },
    { id: 02, pid: null },
    { id: 03, pid: 01 },
    { id: 05, pid: 01 },
    { id: 06, pid: 03 },
    { id: 07, pid: 02 },
    { id: 09, pid: 02 },
    { id: 10, pid: 07 },
]

function toTree(data) {
    let result = [];
    let obj = {};
    data.forEach(item => {
        // console.log(obj);
        obj[item.id] = Object.assign(item, obj[item.id] || {});//把children加入到item中
        if (item.pid) {
            let parent = obj[item.pid] || {};
            parent.child = parent.child || [];
            obj[item.pid] = parent;
        } else {
            result.push(obj[item.id])
        }
    })
    return result;
}
console.log(toTree(list))
