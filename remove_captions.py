import sys
import os

filepath = r'c:\xampp\htdocs\orbosisrealstae\resources\views\index.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    html = f.read()

out = []
i = 0
while i < len(html):
    idx = html.find('<div class="carousel-caption">', i)
    if idx == -1:
        out.append(html[i:])
        break
    # append everything up to the caption
    out.append(html[i:idx])
    # now skip the caption
    i = idx
    div_count = 0
    while i < len(html):
        if html.startswith('<div', i) and not html.startswith('</div>', i):
            div_count += 1
            i += 4
        elif html.startswith('</div', i):
            div_count -= 1
            i += 5
            if div_count == 0:
                # Find the end of this div tag and then trailing whitespace
                i = html.find('>', i) + 1
                while i < len(html) and html[i] in [' ', '\t', '\r']:
                    i += 1
                if i < len(html) and html[i] == '\n':
                    i += 1
                break
        else:
            i += 1

new_content = "".join(out)
with open(filepath, 'w', encoding='utf-8') as f:
    f.write(new_content)
print("done")
