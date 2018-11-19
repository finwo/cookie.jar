#!/usr/bin/env node

function limit_by_cols( str, cols = 80, index = 0) {
  let words = str.split(' '),
      out   = '';
  while(words.length) {
    let sep = '';
    if (index) {index++;sep=' ';}
    index += words[0].length;
    if (index>80) {
      sep = '\n';
      index = words[0].length;
    }
    out += sep + words.shift();
  }
  return out;
}

const stdin  = process.stdin,
      stdout = process.stdout;
let raw  = [];

stdin.resume();
stdin.on('data', chunk => raw.push(chunk));

stdin.on('end', () => {
  let data  = JSON.parse(Buffer.concat(raw)),
      group = data.group;
  if (data.data) data = data.data;
  let index = Math.floor(Math.random() * data.length);
  data = data[index];
  if (group) data.group = group;

  if ( data.quote && data.author ) {
    stdout.write(limit_by_cols(data.quote));
    stdout.write('\n\n');
    stdout.write(' -- ' + data.author + '\n');
  } else if(data.group && data.name && data.text) {
    stdout.write(data.group + '\n');
    stdout.write(data.name  + ':' );
    stdout.write(limit_by_cols(data.text, 80, data.name.length + 1));
    stdout.write('\n');
  } else {
    console.log('UNKNOWN MESSAGE TYPE', data);
  }
});
