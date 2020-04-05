export async function PostQuery (hostname, pathname, data) {
  let queryStr = hostname + pathname + '?'
  let i = 0
  for (const tag in data) {
    if (i !== 0) queryStr += '&'
    queryStr += tag + '=' + data[tag]
    i++
  }
  const response = await fetch(
    queryStr,
    { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
  const result = await response.json()
  return result
}

export async function GetQuery (hostname, pathname, data) {
  let queryStr = hostname + pathname
  if (data.length !== 0) {
    queryStr += '?'
  }
  let i = 0
  for (const tag in data) {
    if (i !== 0) queryStr += '&'
    queryStr += tag + '=' + data[tag]
    i++
  }
  const response = await fetch(
    queryStr,
    { method: 'GET', headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
  const result = await response.json()
  return result
}

export default { PostQuery, GetQuery }
