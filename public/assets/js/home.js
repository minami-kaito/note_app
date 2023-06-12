var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

import ReactPaginate from "https://cdn.skypack.dev/react-paginate@7.1.3";
import React, { useEffect, useState } from "https://cdn.skypack.dev/react@17.0.1";
import ReactDOM from "https://cdn.skypack.dev/react-dom@17.0.1";

var items = js_array;

function Items(_ref) {
  var currentItems = _ref.currentItems;

  return React.createElement(
    "div",
    { "class": "container" },
    React.createElement(
      "div",
      { "class": "table-responsive" },
      React.createElement(
        "table",
        { "class": "table" },
        React.createElement(
          "thead",
          null,
          React.createElement(
            "tr",
            null,
            React.createElement(
              "th",
              { scope: "col", "class": "note-center" },
              "\u30CE\u30FC\u30C8\u30BF\u30A4\u30C8\u30EB"
            ),
            React.createElement(
              "th",
              { scope: "col", "class": "note-center" },
              "\u95B2\u89A7\u306E\u307F"
            ),
            React.createElement(
              "th",
              { scope: "col", "class": "note-center" },
              "\u66F4\u65B0\u65E5\u6642"
            ),
            React.createElement(
              "th",
              { scope: "col", "class": "note-center" },
              "\u524A\u9664\u3059\u308B"
            )
          )
        ),
        React.createElement(
          "tbody",
          null,
          currentItems && currentItems.map(function (item) {
            return React.createElement(
              "tr",
              null,
              React.createElement(
                "td",
                null,
                React.createElement(
                  "div",
                  { "class": "note-title" },
                  React.createElement(
                    "a",
                    { href: "http://localhost/public/note/page?noteid=" + item.note_id },
                    item.title
                  )
                )
              ),
              React.createElement(
                "td",
                { "class": "note-center" },
                React.createElement(
                  "a",
                  { "class": "btn btn-outline-info", href: "http://localhost/public/note/browse?noteid=" + item.note_id },
                  "\u95B2\u89A7\u30E2\u30FC\u30C9"
                )
              ),
              React.createElement(
                "td",
                { "class": "note-center" },
                item.updated_at
              ),
              React.createElement(
                "td",
                { "class": "note-center" },
                React.createElement(
                  "a",
                  { href: "http://localhost/public/note/delete?noteid=" + item.note_id },
                  React.createElement("i", { "class": "bi bi-trash" })
                )
              )
            );
          })
        )
      )
    )
  );
}

function PaginatedItems(_ref2) {
  var itemsPerPage = _ref2.itemsPerPage;

  // We start with an empty list of items.
  var _useState = useState(null),
      _useState2 = _slicedToArray(_useState, 2),
      currentItems = _useState2[0],
      setCurrentItems = _useState2[1];

  var _useState3 = useState(0),
      _useState4 = _slicedToArray(_useState3, 2),
      pageCount = _useState4[0],
      setPageCount = _useState4[1];
  // Here we use item offsets; we could also use page offsets
  // following the API or data you're working with.


  var _useState5 = useState(0),
      _useState6 = _slicedToArray(_useState5, 2),
      itemOffset = _useState6[0],
      setItemOffset = _useState6[1];

  useEffect(function () {
    // Fetch items from another resources.
    var endOffset = itemOffset + itemsPerPage;
    console.log("Loading items from " + itemOffset + " to " + endOffset);
    setCurrentItems(items.slice(itemOffset, endOffset));
    setPageCount(Math.ceil(items.length / itemsPerPage));
  }, [itemOffset, itemsPerPage]);

  // Invoke when user click to request another page.
  var handlePageClick = function handlePageClick(event) {
    var newOffset = event.selected * itemsPerPage % items.length;
    console.log("User requested page number " + event.selected + ", which is offset " + newOffset);
    setItemOffset(newOffset);
  };

  return React.createElement(
    React.Fragment,
    null,
    React.createElement(Items, { currentItems: currentItems }),
    React.createElement(ReactPaginate, {
      nextLabel: ">",
      onPageChange: handlePageClick,
      pageRangeDisplayed: 3,
      marginPagesDisplayed: 2,
      pageCount: pageCount,
      previousLabel: "<",
      pageClassName: "page-item",
      pageLinkClassName: "page-link",
      previousClassName: "page-item",
      previousLinkClassName: "page-link",
      nextClassName: "page-item",
      nextLinkClassName: "page-link",
      breakLabel: "...",
      breakClassName: "page-item",
      breakLinkClassName: "page-link",
      containerClassName: "pagination",
      activeClassName: "active",
      renderOnZeroPageCount: null
    })
  );
}

// Add a <div id="container"> to your HTML to see the componend rendered.
ReactDOM.render(React.createElement(PaginatedItems, { itemsPerPage: 4 }), document.getElementById("container"));