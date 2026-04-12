#!/bin/bash

cat > charles-austin.blade.php << 'EOF'
---
tag: charles-austin
extends: _layouts.tag
section: body
---
EOF

cat > demo.blade.php << 'EOF'
---
tag: demo
extends: _layouts.tag
section: body
---
EOF

cat > homemade-horror-show.blade.php << 'EOF'
---
tag: homemade-horror-show
extends: _layouts.tag
section: body
---
EOF

echo "Created charles-austin.blade.php, demo.blade.php, homemade-horror-show.blade.php"