import{r as o,X as u,Y as g,x as v,a as w}from"./main.ef29de94.js";function K({initialEditor:e,children:x,initialNodes:l,initialTheme:m,skipCollabChecks:C}){const f=o.exports.useRef(!1),n=o.exports.useContext(u);if(n==null)throw Error("Unexpected parent context null on a nested composer");const[s,{getTheme:h}]=n,_=o.exports.useMemo(()=>{const t=m||h()||void 0,b=g(n,t);if(t!==void 0&&(e._config.theme=t),e._parentEditor=s,l)for(const r of l){const c=r.getType();e._nodes.set(c,{klass:r,replace:null,replaceWithKlass:null,transforms:new Set})}else{const r=e._nodes=new Map(s._nodes);for(const[c,p]of r)e._nodes.set(c,{klass:p.klass,replace:p.replace,replaceWithKlass:p.replaceWithKlass,transforms:new Set})}return e._config.namespace=s._config.namespace,e._editable=s._editable,[e,b]},[]),{isCollabActive:d,yjsDocMap:y}=v(),a=C||f.current||y.has(e.getKey());return o.exports.useEffect(()=>{a&&(f.current=!0)},[a]),o.exports.useEffect(()=>s.registerEditableListener(t=>{e.setEditable(t)}),[e,s]),w(u.Provider,{value:_,children:!d||a?x:null})}export{K as L};
