import axios from 'axios';

import {
  LOG_IN,
  saveUserToken,
  GET_INFOS,
  getInfos,
  saveUserInfos,
  DELETE_PROFILE,
  UPDATE_PROFILE,
  logOut,
  SAVE_PROFIL_API,
  CREATE_ACCOUNT,
} from '../actions/user';
import {
  FETCH_AGES,
  saveAges,
  FETCH_EVENTS,
  saveEvents,
  FETCH_CATEGORIES,
  saveCategories,
  FETCH_GENDER,
  saveGender,
  FETCH_PROFILES,
  fetchProfiles,
  saveProfiles,
  FETCH_PRODUCTS,
  saveProducts,
  loaderOff,
  displayError,
  SAVE_SEARCH,
  fetchProducts,
  SEARCH_TO_API,
} from '../actions/okdo';

const middleware = (store) => (next) => (action) => {
  // we will react to specified actions
  switch (action.type) {
    // We send a post request to the API with mail and PW, to get the token
    case LOG_IN:
      axios.post(
        'https://back.o-kdo.org/api/login_check',
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/login_check',

        {
          email: store.getState().mailLogin,
          password: store.getState().passwordLogin,
        },
        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
          },
        },
      )

        .then((response) => {
          // We save the token into the state
          const newAction = saveUserToken(
            response.data.token,
          );
          store.dispatch(newAction);
          // Put the token in the localStorage
          const { token } = response.data;
          localStorage.setItem('newToken', token);
        })
        .then(() => {
          // eslint-disable-next-line max-len
          // Then we call the getInfos action to send a get request to get the informations related to the token
          store.dispatch(getInfos());
        })
        .catch((error) => {
          console.warn(error);
          store.dispatch(loaderOff());
        });

      break;

    // After getting the User's token
    // We retrieves all User's infos(firstname,lastname and roles) by a GET call on API
    case GET_INFOS:

      axios.get(
        'https://back.o-kdo.org/api/secure/login_check',
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/login_check',
        {
          headers: { Authorization: `Bearer ${store.getState().token}` },
        },
      )
        .then((response) => {
          const {
            firstname,
            lastname,
            roles,
            id,
          } = response.data;

          // We saves User's infos in the state after the connection
          store.dispatch(saveUserInfos(firstname, lastname, roles, id));
          // We call the fetchProfiles action to get the profiles related to the user
          store.dispatch(fetchProfiles());
        })
        .catch((error) => {
          console.warn(error);
          store.dispatch(logOut());
        });

      break;

    case FETCH_AGES:
      // Call  API for retrieves Ages options
      axios.get(
        'https://back.o-kdo.org/api/ages',
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/ages',
      )
        .then((response) => {
          const ages = response.data;
          // we dispatch an action conveying these ages to take them to the reducer
          // and put them in the state
          store.dispatch(saveAges(ages));
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case FETCH_EVENTS:
      // Call  API for retrieves Events options
      axios.get(
        'https://back.o-kdo.org/api/events',
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/events',
      )
        .then((response) => {
          const events = response.data;
          // we dispatch an action conveying these events to take them to the reducer
          // and put them in the state
          store.dispatch(saveEvents(events));
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case FETCH_CATEGORIES:
      // Call  API for retrieves Categories options
      axios.get(
        'https://back.o-kdo.org/api/categories',
      //   'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/categories',
      )
        .then((response) => {
          const categories = response.data;
          // we dispatch an action conveying these categories to take them to the reducer
          // and put them in the state
          store.dispatch(saveCategories(categories));
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case FETCH_GENDER:
      // Call  API for retrieves Gender options
      axios.get(
        'https://back.o-kdo.org/api/genres',
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/genres',
      )
        .then((response) => {
          const gender = response.data;
          // we dispatch an action conveying these genders to take them to the reducer
          // and put them in the state
          store.dispatch(saveGender(gender));
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

      // Call  API for retrieves saved profiles
    case FETCH_PROFILES:
      axios.get(
        `https://back.o-kdo.org/api/secure/user/${store.getState().id}/profiles`,
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/user/${store.getState().id}/profiles`
        {
          headers: { Authorization: `Bearer ${store.getState().token}` },
        },
      )
        .then((response) => {
          const profiles = response.data;
          // we dispatch an action conveying these profiles to take them to the reducer
          // and put them in the state
          store.dispatch(saveProfiles(profiles));
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case DELETE_PROFILE:
      axios.delete(
        `https://back.o-kdo.org/api/secure/profiles/${store.getState().idToSupp}`,
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/profiles/${store.getState().idToSupp}`,

        {
          headers: { Authorization: `Bearer ${store.getState().token}` },
        },
      )
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case UPDATE_PROFILE:
      axios.put(
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/profiles/${store.getState().idChosen}`,
        `https://back.o-kdo.org/api/secure/profiles/${store.getState().idChosen}`,

        {
          name: store.getState().editNameProfileInput,
          categories: store.getState().categoryChosen.map((item) => (item.id)),
          // We take the index 0 of the array, because BDD accept only one value here
          Genre: store.getState().genderChosen[0].id,
          Event: store.getState().eventChosen[0].id,
          Ages: store.getState().ageChosen.map((item) => (item.id)),
        },
        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${store.getState().token}`,
          },
        },
      )
        .then(() => {
          store.dispatch(getInfos());
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case FETCH_PRODUCTS:
      axios.get(
        // 'https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/products',
        'https://back.o-kdo.org/api/products',

        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
            // Authorization: `Bearer ${store.getState().token}`,
          },
        },
      )
        .then((response) => {
          console.log(response);
          const productResearch = response.data;
          store.dispatch(saveProducts(productResearch));

          // si aucun product n'a été trouvé on redirige vers une erreur
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case SEARCH_TO_API:
      axios.post(
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/profiles/${store.getState().idChosen}`,
        'https://back.o-kdo.org/api/search',

        {
          categories: store.getState().categoriesSearch.map((item) => (item.id)),
          ages: store.getState().agesSearch.map((item) => (item.id)),
          genres: store.getState().genderSearch.map((item) => (item.id)),
          events: store.getState().eventSearch.map((item) => (item.id)),
        },
        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
          },
        },
      )
        .then((response) => {
          store.dispatch(saveProducts(response));
          // si aucune recette n'a été trouvée on redirige vers une erreur
        })
        .then(() => {
          store.dispatch(loaderOff());
          // si aucune recette n'a été trouvée on redirige vers une erreur
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case SAVE_PROFIL_API:
      axios.post(
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/profiles/${store.getState().idChosen}`,
        `https://back.o-kdo.org/api/secure/user/${store.getState().id}/profiles`,

        {
          name: store.getState().registeredProfil,
          categories: store.getState().categoriesSearch.map((item) => (item.id)),
          ages: store.getState().agesSearch.map((item) => (item.id)),
          genre: store.getState().genderSearch[0].id,
          event: store.getState().eventSearch[0].id,
        },
        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${store.getState().token}`,
          },
        },
      )
        .then((response) => {
          console.log(response);
          store.dispatch(fetchProfiles());
        })
        .catch((error) => {
          console.error(error);
          store.dispatch(displayError());
        });

      break;

    case CREATE_ACCOUNT:
      axios.post(
        // `https://marchandladislas-server.eddi.cloud/OKDO/projet-O-Kdo-back/OKDO/public/api/secure/profiles/${store.getState().idChosen}`,
        'https://back.o-kdo.org/api/users',

        {
          email: store.getState().mailSignIn,
          password: store.getState().passwordSignIn,
          firstname: store.getState().firstNameSignIn,
          lastname: store.getState().lastNameSignIn,
        },
        {
          headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
          },
        },
      )
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });

      break;

    default:
  }
  // passing all actions to the reducer
  next(action);
};

export default middleware;
