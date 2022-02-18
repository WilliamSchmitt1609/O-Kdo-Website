import { useSelector } from 'react-redux';

import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';
import Profil from 'src/components/Profiles/Profil';
import PopUpDel from 'src/components/Profiles/PopUpDel';

import './style.scss';

// import '../Home/style.scss';

const Profiles = () => {
  const profileList = useSelector((state) => state.profiles);
  const popUpDel = useSelector((state) => state.showPopUpDel);

  return (
    <>
      <AppHeader />
      <div className="content profilesContent">
        <main className="main profilPage">
          { popUpDel ? <PopUpDel /> : null }
          <div className="invisible-div" />
          <h1 className="profiles-title">Mes profils enregistrés</h1>
          <div className="cardsContainer">
            {profileList.map((profil) => (
              <Profil
                name={profil.name}
                key={profil.name}
                id={profil.id}
                categories={profil.categories}
                genre={profil.genre}
                event={profil.event}
                ages={profil.ages}
                slug={profil.id}
              />
            ))}
          </div>
        </main>
        <Footer />
      </div>
    </>
  );
};

export default Profiles;
