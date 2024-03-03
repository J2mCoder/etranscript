const xhr = new xhrHttpRequest()

xhr.open('GET', 'http://', true)
xhr.onreadystatechange = () => {
  if (xhr.readyState === 4 && xhr.status === 200) {
    const body = JSON.parse(xhr.response)
  } else {
    console.log('error')
  }
}

xhr.send()