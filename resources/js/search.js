
import {instantMeiliSearch} from "@meilisearch/instant-meilisearch";
import instantsearch from "instantsearch.js"
import {configure, searchBox, hits} from 'instantsearch.js/es/widgets'


const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

let firstSearch = true;

console.log("hello world app.js")

window.instantsearch = instantsearch

window.search = instantsearch({
    indexName: 'boxes',
    searchClient: instantMeiliSearch(
        import.meta.env.VITE_MEILISEARCH_HOST,
        '8f3b1fa21c58a8278e940c80694866b863defb7e5ecafd4b323d21758885316d'
    ),
    searchFunction(helper) {
        console.log(params.q && !helper.state.query && firstSearch)
        if (params.q && !helper.state.query && firstSearch) {
            helper.setQuery(params.q)
            helper.search();
            firstSearch = false;
        } else {
            helper.search();
        }

    },
})



async function getTemplate(name) {
    const response = await fetch(`/template/${name}`);
    return await response.text();
}


search.addWidgets([
    configure({

    }),
    searchBox({
        container: "#searchbox",
        placeholder: "Search",
        showReset: false,
        searchAsYouType: true,

        templates: {

            submit(a,b,c) {
                return "<i class=\"far fa-magnifying-glass text-xl\"></i>"
            },
        },
        cssClasses: {
            input: 'w-64 transition-all duration-500 focus:w-full max-w-screen-md rounded-full px-5',
            submitIcon: 'w-5 h-5 fill-current',
            form: 'flex relative items-center mb-0 justify-end mr-8 mr-6 md:mr-0',
            submit: 'absolute right-5 hover:text-blue-600',
            root: 'flex-grow',
        }
    }),
    // instantsearch.widgets.clearRefinements({
    //     container: "#clear-refinements"
    // }),
    // instantsearch.widgets.refinementList({
    //     container: "#genres-list",
    //     attribute: "genres"
    // }),
    // instantsearch.widgets.refinementList({
    //     container: "#players-list",
    //     attribute: "players"
    // }),
    // instantsearch.widgets.refinementList({
    //     container: "#platforms-list",
    //     attribute: "platforms"
    // }),
    // instantsearch.widgets.configure({
    //     hitsPerPage: 6,
    //     snippetEllipsisText: "...",
    //     attributesToSnippet: ["description:50"]
    // }),
    // instantsearch.widgets.refinementList({
    //     container: "#misc-list",
    //     attribute: "misc"
    // }),

    hits({
        container: "#hits",
        gap: 3,
        colClass: "w-full sm:w-1/2 md:w-1/3 max-w-screen-sm",
        cssClasses: {
            root: 'MyCustomHits',
            list: 'flex items-center justify-start -my-3 -mx-3 flex-wrap',
            item: 'py-3 px-3 w-full sm:w-1/2 md:w-1/3 max-w-screen-sm'
        },
        templates: {
          item: await getTemplate('box'),
        },
    }),
    // instantsearch.widgets.pagination({
    //     container: "#pagination"
    // })
]);

search.start();

document.querySelector("#searchbox form").setAttribute('action', '/search')
document.querySelector("#searchbox form input").setAttribute('name', 'q')
document.querySelector("#searchbox form").addEventListener("submit", function (e) {
    e.target.submit()
})
