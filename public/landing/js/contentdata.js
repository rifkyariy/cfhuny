// set Content - Mengisi target html dengan tag yang diingikan
var setContent = (target,contentData) => {
    let selector =  document.querySelector(target);
    let htmlString;
    
    contentData.data.forEach(element => {
        htmlString = contentData.html(element);
        selector.innerHTML += htmlString;
    });
}

// reset Content
var resetContent = (target) => {
    let selector =  document.querySelector(target);
    let htmlString = '';
    selector.innerHTML = htmlString;
}



// memberikan index pada sebuah objek
let generateIndex = (targetJson) => {
    let x = 0;
    outData = targetJson
    outData.data.forEach(element => {
        element.index = x;
        x++;
    });

    return outData;
}

// membuat list - semacam pagination
let generateList = (array, page_size, page_number) => {
    return array.slice((page_number - 1) * page_size, page_number * page_size);
}

// expand and less fun

var toggle = 0;
let expandFaqFun = (defaultSize, pageSize) => {
    let newSize = pageSize;
    
    // Menentukan expand atau less
    if(toggle  == 0){

        // menentukan size
        if((generateIndex(faqcontent).data.length - newSize) >= pageSize){
            newSize = newSize + pageSize;
        }else{
            newSize = newSize + generateIndex(faqcontent).data.length - newSize;
        }

        // reset list, generate list dan menentukan masih expand atau less 
        if(newSize < generateIndex(faqcontent).data.length){
            faqExpand.data[0].onclick = `expandFaqFun(${defaultSize},${newSize})`;
            resetContent("#accordionExample");
            setFaq(newSize,1,generateIndex(faqcontent));
            toggle = 0;
        }else{
            faqExpand.data[0].onclick = `expandFaqFun(${defaultSize},${defaultSize})`;
            resetContent("#accordionExample");
            setFaq(newSize,1,generateIndex(faqcontent));
            document.querySelector('#expandFaq').innerHTML = ('Less')
            toggle = 1;
        }
    }else{
        resetContent("#accordionExample");
        setFaq(pageSize,1,generateIndex(faqcontent));
        document.querySelector('#expandFaq').innerHTML = ('Expand')
        toggle = 0;
    }

}

// data

// carousel gemastik

var carouselcontent = {
    'html' : (data) => {
        return `
        <div class="carousel-item ${data.status}">
                    <div class="backgroundpattern"> 
                        <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h4 class="subtitle">${data.subtitle}</h4>
                                    <h2 class="title">${data.title}</h2>
                                    <p class="text">${data.desc}</p>
                                    <ul class="slider-btn rounded-buttons">
                                        ${data.buttonAdd}
                                        <li><a class="main-btn rounded-one" href="${data.link}">${data.button}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="${data.image}" alt="${data.title}">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                    </div>
                </div> <!-- carousel-item -->
        `   
    },
    'data' : [
        {
            'subtitle' : `Selamat Datang Di`,
            'title' : `Website Resmi UNY Cartesion `,
            'desc' : `Submit ide kreatifmu dan dapatkan bimbingan eksklusif.`,
            'status' : `active`,
            'button' : `Daftar Sekarang`,
            'buttonAdd' : `<li><a class="main-btn rounded-two" href="/panduan">Lihat Panduan</a></li>`,
            'link': `/teams`,
            'image': `landing/images/slider/wfh2.svg`
        },
        {
            'subtitle' : `Agenda dan Timeline `,
            'title' : `Timeline UNY Cartesion`,
            'desc' : `Ingin ikut tapi bingung alurnya ? Yuk simak timelinenya.`,
            'status' : ``,
            'button' : `Lihat Timeline`,
            'buttonAdd' : ``,
            'link': `/timeline`,
            'image': `landing/images/slider/timeline.svg`
        },
        {
            'subtitle' : `Pengumuman `,
            'title' : `Perpanjangan Pendaftaran Online `,
            'desc' : `Daripada gabut ye kan, mending ikuti pendampingan online biar paham.`,
            'status' : ``,
            'button' : `Daftar Sekarang`,
            'buttonAdd' : ``,
            'link': `/teams`,
            'image': `landing/images/slider/wfh.svg`
        }
        
    ]

}

// tentang unyCartesion
var tentangUnyCartesion = {
    'html' : (data) => {
        return `
        <h6 class="sub-title">${data.subtitle}</h6>
        <h4 class="title">${data.title}</h4>
        <ul class="testimonial-line">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <p class="text">
            ${data.desc}
        </p>
        `   
    },
    'data' : [
        {
            'subtitle' : `Apa itu `,
            'title' : `UNY National Cartesion`,
            'desc' : `<b>UNY National Cartesion</b> adalah Kompetensi Nasional yang diselenggarakan secara online oleh Universitas Negeri Yogyakarta <br/><br/>
            Program ini bertujuan untuk menjaring ide atau gagasan cemerlang serta memfasilitasi mahasiswa untuk berkarya dan mengembangkan kreativitasnya baik dalam bidang pendidikan, kewirausahaan maupun seni. 
            `
        }
    ]

}

// bidang lomba
var kategorilombacontent = {
    'html' : (data) => {return `
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h6 class="features-title"><a href="#">${data.title}</a></h6>
                            <div class="features-icon">
                                <img src="${data.image}" alt="${data.title}" width="100%" height="120px">
                            </div>
                        </div>
                        <div class="features-content multiline-ellipsis">
                            <p class="text ">
                                ${data.desc}
                            </p>
                        </div>
                        <div class="features-content">
                            <a class="features-btn" href="${data.link}">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                `},
    'data' : [
        {
            'title' : 'KATEGORI PENDIDIKAN',
            'image' : '/landing/images/icon/edu.svg',
            'desc': `Lomba ini bertujuan untuk menyalurkan ide dan kreatifitas mahasiswa dalam mengembangkan inovasi multimedia pembelajaran dan inovasi pembelajaran`,
            'link': '/bidangPendidikan' 
        },
        {
            'title' : 'KATEGORI KEWIRAUSAHAAN',
            'image' : '/landing/images/icon/bus.svg',
            'desc': `Lomba ini bertujuan untuk memberikan kontribusi nyata dalam membantu permasalahan UMKM di Indonesia sebagai dampak pandemi Covid-19`,
            'link': '/bidangKwu' 
        },
        {
            'title' : 'KATEGORI SENI',
            'image' : '/landing/images/icon/art.svg',
            'desc': `Lomba ini bertujuan untuk mengembangangkan potensi mahasiswa di bidang seni terutama pada bakat - bakat paduan suara dan vokal grup, sastra, dan musik`,
            'link': '/bidangSeni   ' 
        },
      
    ]
}
//berita

// frequently asked questions
// faq title
var faqtitle = {
    'html' : (data) => {
        return `
            <h6 class="sub-title">${data.subtitle}</h6>
            <h4 class="title">${data.title}</h4>
        `
    },
    'data' : [
        {
            'subtitle' : "Frequently Asked Questions",
            'title' : 'Pertanyaan yang sering ditanyakan '
        }
    ]
}

// faq content
var faqcontent = {
    'html' : (data) => {
        return `
            <div class="card">
                <div class="card-header" id="heading${data.index}">
                    <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse${data.index}"
                        aria-expanded="false" aria-controls="collapse${data.index}">
                        <b>${data.title}</b>
                    </a>
                </div>

                <div id="collapse${data.index}" class="collapse" aria-labelledby="heading${data.index}"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p class="text">
                            ${data.answer}
                        </p>
                    </div>
                </div>
            </div> <!-- card -->
        `
    },
    'data' : [
            {
                'title' : 'UNY National Cartesion itu apa kak ?',
                'answer' : '<b>UNY National Cartesion</b> adalah Kompetensi Nasional yang diselenggarakan secara online oleh Universitas Negeri Yogyakarta'
            },
            {
                'title' : 'Pendaftaran Kapan ya kak?',
                'answer' : 'Bisa dicek di timeline pendaftaran'
            },
            {
                'title' : 'Syarat untuk daftar apa aja kak?',
                'answer' : 'Kuy kepoin syarat pendaftaran di link berikut <a href="/syaratunycartesion"><b>Syarat Ketentuan</b> </a>'
            },
            {
                'title' : 'Bagaimana tahap pendaftaran',
                'answer' : 'Bisa dicek di di link panduan berikut <a href="/panduan"><b>Panduan</b> </a> '
            },
            {
                'title' : 'Ini nanti semua lombanya online kak? ',
                'answer' : 'Iyap lombanya semua online'
            },       
        ]
}

// button expand -> FAQ
var faqExpand = {
    'html'  : (data) => {
        return `
            <a class="main-btn mt-40 rounded-two expandbtn" onclick="${data.onclick}" id="${data.id}">${data.button}</a>
        `
    },
    'data' : [
        {
            'id' : 'expandFaq',
            'button' : 'Expand'
        }
    ]
}




let setFaq = (page_size,page, targetJson ) => {
    const dataLength = targetJson.data.length;
    const htmlString = targetJson.html;
    const limitData = generateList(targetJson.data, page_size, page);
    const newJson = 
        {
            'html' : htmlString,
            'data' : limitData
        }

    setContent("#accordionExample",newJson);
    setContent("#accordionExample",faqExpand);
}




// init fun
let initFaq = (pageSize) => {
    setContent(".about-title",faqtitle);
    faqExpand.data[0].onclick = `expandFaqFun(${pageSize},${pageSize})`;
    setFaq(pageSize,1,generateIndex(faqcontent));
}

// init
setContent(".kategori-lomba-content",kategorilombacontent);
setContent(".tentang-UnyCartesion-content",tentangUnyCartesion);
setContent(".carousel-inner",carouselcontent);
initFaq(4);



// after all sets

// responsive mobile view
window.addEventListener('resize', () => {
    // We execute the same script as before
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
});

$(document).ready(() => {
    $('#input-university').select2({
        ajax: {
          url: '/api/sel2/perguruantinggi',
          dataType: 'json',
          delay: 250,
          data: function (params) {
            var query = {
              search: params.term
            }
  
            // Query parameters will be ?search=[term]&page=[page]
            return query;
          },
          processResults: function (data) {
              console.log(data);
              
            return {
              results: $.map(data, function(obj) {
                return {
                  id: obj.id,
                  text: obj.text
                };
              })
            };
          },
          cache: true
        },
        placeholder: 'Pilih Perguruan Tinggi'
      });
});

$('#input-university').on('change',() => {
    let name = " ";
    let id = $('#input-university :selected').val();
    name = $('#input-university :selected').text();
    $('.info').show();
    $('.info .result').html(`
        <h6 class="result-title">Hasil Pencarian</h6>
        <h4 class="univ_name">${name}</h4>
        <h4 class="univ_name">Kode Perguruan Tinggi : ${id}</h4>
    `)
})
