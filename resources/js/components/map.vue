<template lang="pug">
.pickup-pointers
  .wrapper
    .mapWrapper
      .pointsWrapp

        .points
          .point(v-for="post in posts" @click="scrollTo(post)")
            img(src="/images/location.svg")
            span {{post.title}}
      .map#mapMainPage
        
</template>
<script>
export default ({
    data() {
      return {
        myMap: null,
        myPoints: [],

        selectedCity: 6,
        availablePoints: []
      }
    },
    props: {
        posts: Array
    },
    computed: {
    },
    methods: {
      init() {
        if(!this.myMap) {
            var map = new ymaps.Map('mapMainPage', {
                center: [27.561821, 53.902292],
                zoom: 11,
                controls: ['zoomControl']
            })
            this.myMap = map
            this.setPoints2(map)
        } else {
            this.setPoints2(this.myMap)
        }
      },
      setPoints2(map) {
        var myPoints = [];
        for(let key in this.posts) {
            let address = this.posts[key].address
            let coords = this.posts[key].coords
            let title = this.posts[key].title
        //   let city = this.posts[key].cityId
            coords = coords.split(',')
            for(let keyCoords in coords) {
              coords[keyCoords] = parseFloat(coords[keyCoords])
            }
            coords = coords.reverse()
            myPoints.push({
                coords: coords,
                text: address,
            })




            map.geoObjects.add(new ymaps.Placemark(coords, {
                balloonContent: address,
                iconCaption: title
            }, {
                preset: 'islands#blueCircleDotIconWithCaption',
                iconCaptionMaxWidth: '50'
            }))
        }
      },
      scrollTo(post) {
        let coords = post.coords.split(',')
        for(let keyCoords in coords) {
            coords[keyCoords] = parseFloat(coords[keyCoords])
        }
        coords = coords.reverse()
        this.myMap.setCenter(coords)
      },
      updatePoints() {
        var result = []
        for (let key in this.myPoints) {
          if (this.myPoints[key].city == this.selectedCity) {
            result.push(this.myPoints[key])
          }
        }
        this.availablePoints = result
      }
    },
    watch: { 
        posts: function(newVal, oldVal) {
            if(this.myMap == null) {
                this.init()
            } else {
                this.myMap.geoObjects.removeAll()
                this.init()
            }
            
        }
    },
    mounted() {
      ymaps.ready(this.init);
    }
})
</script>
<style>
.pickup-pointers {
  padding-bottom: 100px;
}
.pickup-pointers h2 {
  font-weight: 600;
  font-size: 36px;
  line-height: 49px;
  padding-bottom: 30px;
}
.pickup-pointers .mapWrapper {
  display: inline-flex;
  background: #fff;
  border: 1px solid #e2e2e2;
  box-sizing: border-box;
  border-radius: 5px 0px 0px 5px;
  width: 100%;
}
.pickup-pointers .mapWrapper .pointsWrapp {
  flex: 0 0 30%;
  padding: 40px 20px 0px 20px;
}
.pickup-pointers .mapWrapper .pointsWrapp .search {
  border-radius: 5px;
  border: 1px solid #a3a3a3;
  height: 40px;
  margin-bottom: 20px;
  width: 100%;
}
.pickup-pointers .mapWrapper .pointsWrapp .search:after {
  content: url("/img/icons/search-icon.svg");
}
.pickup-pointers .mapWrapper .pointsWrapp .points {
  max-height: 350px;
  overflow-y: auto;
}
.pickup-pointers .mapWrapper .pointsWrapp .points .point {
  border-bottom: 1px solid #c2c2c2;
  padding: 10px 0px;
  cursor: pointer;
}
.pickup-pointers .mapWrapper .pointsWrapp .points .point img {
  padding-right: 5px;
}
.pickup-pointers .mapWrapper .map {
  flex: 0 0 70%;
  height: 450px;
}

          
    </style>
    