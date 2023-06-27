import{m as O,G as F,c as s,q as o,a9 as c,aa as H,ab as W,ac as X,ad as z,A as U,ae as j,af as G,ag as q,ah as V,ai as x,l as J,aj as _,i as Q,ak as Z,al as L,am as S,an as ee,ao as te,ap as ne,aq as re,ar as P,as as se,at as ae,au as oe,av as k,aw as ie,u as N,ax as le,j as T,F as ce,a as g,ay as ue,az as fe,aA as me,r as D,x as de,H as Ce,R as ge,T as pe,U as Ee,W as De,X as he,Y as _e,$ as y,aB as R}from"./main.0c370d41.js";import{L as ye}from"./LexicalNestedComposer.a322e9ed.js";function b(n,a){a.update(()=>{const e=n instanceof KeyboardEvent?null:n.clipboardData,t=s();if(t!==null&&e!=null){n.preventDefault();const i=oe(a);i!==null&&e.setData("text/html",i),e.setData("text/plain",t.getTextContent())}})}function Re(n,a){n.preventDefault(),a.update(()=>{const e=s(),t=n instanceof InputEvent||n instanceof KeyboardEvent?null:n.clipboardData;t!=null&&o(e)&&P(t,e)},{tag:"paste"})}function Te(n,a){b(n,a),a.update(()=>{const e=s();o(e)&&e.removeText()})}function Ne(n){return O(n.registerCommand(_,e=>{const t=s();return o(t)?(t.deleteCharacter(e),!0):!1},c),n.registerCommand(ae,e=>{const t=s();return o(t)?(t.deleteWord(e),!0):!1},c),n.registerCommand(se,e=>{const t=s();return o(t)?(t.deleteLine(e),!0):!1},c),n.registerCommand(re,e=>{const t=s();if(!o(t))return!1;if(typeof e=="string")t.insertText(e);else{const i=e.dataTransfer;if(i!=null)P(i,t);else{const u=e.data;u&&t.insertText(u)}}return!0},c),n.registerCommand(ne,()=>{const e=s();return o(e)?(e.removeText(),!0):!1},c),n.registerCommand(x,e=>{const t=s();return o(t)?(t.insertLineBreak(e),!0):!1},c),n.registerCommand(te,()=>{const e=s();return o(e)?(e.insertLineBreak(),!0):!1},c),n.registerCommand(ee,e=>{const t=s();if(!o(t))return!1;const i=e,u=i.shiftKey;return L(t,!0)?(i.preventDefault(),S(t,u,!0),!0):!1},c),n.registerCommand(Z,e=>{const t=s();if(!o(t))return!1;const i=e,u=i.shiftKey;return L(t,!1)?(i.preventDefault(),S(t,u,!1),!0):!1},c),n.registerCommand(Q,e=>{const t=s();return o(t)?(e.preventDefault(),n.dispatchCommand(_,!0)):!1},c),n.registerCommand(J,e=>{const t=s();return o(t)?(e.preventDefault(),n.dispatchCommand(_,!1)):!1},c),n.registerCommand(U,e=>{const t=s();if(!o(t))return!1;if(e!==null){if((j||G||q)&&V)return!1;e.preventDefault()}return n.dispatchCommand(x,!1)},c),n.registerCommand(z,e=>{const t=s();return o(t)?(b(e,n),!0):!1},c),n.registerCommand(X,e=>{const t=s();return o(t)?(Te(e,n),!0):!1},c),n.registerCommand(W,e=>{const t=s();return o(t)?(Re(e,n),!0):!1},c),n.registerCommand(H,e=>{const t=s();return o(t)?(e.preventDefault(),!0):!1},c),n.registerCommand(F,e=>{const t=s();return o(t)?(e.preventDefault(),!0):!1},c))}function Ae(n){k(()=>O(Ne(n),ie(n)),[n])}function Me({contentEditable:n,placeholder:a,ErrorBoundary:e}){const[t]=N(),i=le(t,e);return Ae(t),T(ce,{children:[n,g(ve,{content:a}),i]})}function ve({content:n}){const[a]=N(),e=ue(a),t=fe();return e?typeof n=="function"?n(t):n:null}const xe={...me,paragraph:"StickyEditorTheme__paragraph"};var Le=xe;function h(n,a){const e=n.style,t=a.rootElementRect,i=t!==null?t.left:0,u=t!==null?t.top:0;e.top=u+a.y+"px",e.left=i+a.x+"px"}function Pe({x:n,y:a,nodeKey:e,color:t,caption:i}){const[u]=N(),p=D.exports.useRef(null),E=D.exports.useRef({isDragging:!1,offsetX:0,offsetY:0,rootElementRect:null,x:0,y:0}),{isCollabActive:I}=de();D.exports.useEffect(()=>{const r=E.current;r.x=n,r.y=a;const f=p.current;f!==null&&h(f,r)},[n,a]),k(()=>{const r=E.current,f=new ResizeObserver(C=>{for(let d=0;d<C.length;d++){const K=C[d],{target:w}=K;r.rootElementRect=w.getBoundingClientRect();const v=p.current;v!==null&&h(v,r)}}),l=u.registerRootListener((C,d)=>{d!==null&&f.unobserve(d),C!==null&&f.observe(C)}),m=()=>{const C=u.getRootElement(),d=p.current;C!==null&&d!==null&&(r.rootElementRect=C.getBoundingClientRect(),h(d,r))};return window.addEventListener("resize",m),()=>{window.removeEventListener("resize",m),l()}},[u]),D.exports.useEffect(()=>{const r=p.current;r!==null&&setTimeout(()=>{r.style.setProperty("transition","top 0.3s ease 0s, left 0.3s ease 0s")},500)},[]);const A=r=>{const f=p.current,l=E.current,m=l.rootElementRect;f!==null&&l.isDragging&&m!==null&&(l.x=r.pageX-l.offsetX-m.left,l.y=r.pageY-l.offsetY-m.top,h(f,l))},M=r=>{const f=p.current,l=E.current;f!==null&&(l.isDragging=!1,f.classList.remove("dragging"),u.update(()=>{const m=y(e);R(m)&&m.setPosition(l.x,l.y)})),document.removeEventListener("pointermove",A),document.removeEventListener("pointerup",M)},B=()=>{u.update(()=>{const r=y(e);R(r)&&r.remove()})},Y=()=>{u.update(()=>{const r=y(e);R(r)&&r.toggleColor()})},{historyState:$}=Ce();return g("div",{ref:p,className:"sticky-note-container",children:T("div",{className:`sticky-note ${t}`,onPointerDown:r=>{const f=p.current;if(f==null||r.button===2||r.target!==f.firstChild)return;const l=f,m=E.current;if(l!==null){const{top:C,left:d}=l.getBoundingClientRect();m.offsetX=r.clientX-d,m.offsetY=r.clientY-C,m.isDragging=!0,l.classList.add("dragging"),document.addEventListener("pointermove",A),document.addEventListener("pointerup",M),r.preventDefault()}},children:[g("button",{onClick:B,className:"delete","aria-label":"Delete sticky note",title:"Delete",children:"X"}),g("button",{onClick:Y,className:"color","aria-label":"Change sticky note color",title:"Color",children:g("i",{className:"bucket"})}),T(ye,{initialEditor:i,initialTheme:Le,children:[I?g(ge,{id:i.getKey(),providerFactory:pe,shouldBootstrap:!0}):g(Ee,{externalHistoryState:$}),g(Me,{contentEditable:g(De,{className:"StickyNode__contentEditable"}),placeholder:g(he,{className:"StickyNode__placeholder",children:"What's up?"}),ErrorBoundary:_e})]})]})})}export{Pe as default};
